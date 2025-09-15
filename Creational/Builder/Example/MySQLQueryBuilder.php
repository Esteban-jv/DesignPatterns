<?php
/**
 * QueryBuilder is a simple query builder class that allows you to build SQL queries
 * by chaining methods together. This is a simple example and does not cover all
 * possible SQL query scenarios.
 */
require_once __DIR__ . '/QueryBuilder.php';

class MySQLQueryBuilder implements QueryBuilder
{
    private $table;
    private $fields = [];
    private $conditions = [];
    private $orderFields = [];
    private $limitCount;

    public function __construct($table)
    {
        $this->table = $table;
    }

    /**
     * Expects an array of fields
     * @param array $fields
     * @return QueryBuilder
     */
    public function select($fields): QueryBuilder
    {
        $this->fields = $fields;
        return $this;
    }

    /**
     * Expects a single condition
     * @param string $condition
     * @return QueryBuilder
     */
    public function where($condition, $operator, $value): QueryBuilder
    {
        $this->conditions[] = count($this->conditions) === 0 ? "WHERE $condition $operator '$value'" : "AND $condition $operator '$value'";
        return $this;
    }

    /**
     * Expects a single order field, optionally a direction, defaults to ASC
     * @param string $fields
     * @param string $direction
     * @return QueryBuilder
     */
    public function orderBy($field, $direction = 'ASC'): QueryBuilder
    {
        $this->orderFields[] = count($this->orderFields) === 0 ? "ORDER BY $field $direction" : "$field $direction";
        return $this;
    }

    /**
     * Expects a single limit count
     * @param int $count
     * @return QueryBuilder
     */
    public function limit($count): QueryBuilder
    {
        $this->limitCount = "LIMIT $count";
        return $this;
    }

    public function getQuery(): string
    {
        return "SELECT " .
            implode(', ', $this->fields) .
            " FROM $this->table " .
            implode(' ', $this->conditions) .
            " " .
            implode(', ', $this->orderFields) .
            " " .
            $this->limitCount;
    }
}