<?php
require_once __DIR__ . '/QueryBuilder.php';

class MongoQueryBuilder implements QueryBuilder
{
    private $collection;
    private $fields = [];
    private $filters = [];
    private $sortFields = [];
    private $limitCount;

    public function __construct($collection)
    {
        $this->collection = $collection;
    }

    public function select($fields): QueryBuilder
    {
        foreach ($fields as $field) {
            $this->fields[$field] = 1;
        }
        return $this;
    }

    public function where($field, $operator, $value): QueryBuilder
    {
        $mongoOperator = match (strtolower($operator)) {
            '>' => '$gt',
            '<' => '$lt',
            '>=' => '$gte',
            '<=' => '$lte',
            '=' => '$eq',
            '!=' => '$ne',
            'like' => '$regex',
            default => throw new Exception("Operador $operator no soportado"),
        };

        if ($mongoOperator === '$regex') {
            // para LIKE, asume %A% → "A"
            $this->filters[$field] = [ '$regex' => $value, '$options' => 'i' ];
        } else {
            $this->filters[$field] = [ $mongoOperator => $value ];
        }

        return $this;
    }

    public function orderBy($field, $direction = 'ASC'): QueryBuilder
    {
        $this->sortFields[$field] = strtoupper($direction) === 'DESC' ? -1 : 1;
        return $this;
    }

    public function limit($count): MongoQueryBuilder
    {
        $this->limitCount = $count;
        return $this;
    }

    public function getQuery(): string
    {
        $query = "db.{$this->collection}.find(";

        $filterJson = empty($this->filters) ? '{}' : json_encode($this->filters, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        $fieldsJson = empty($this->fields) ? '{}' : json_encode($this->fields, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

        $query .= "$filterJson, $fieldsJson)";

        if (!empty($this->sortFields)) {
            $sortJson = json_encode($this->sortFields, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
            $query .= ".sort($sortJson)";
        }

        if (!empty($this->limitCount)) {
            $query .= ".limit($this->limitCount)";
        }

        return $query . ";";
    }
}