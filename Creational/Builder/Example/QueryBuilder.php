<?php
interface QueryBuilder
{
    public function select(array $columns): QueryBuilder;
    public function where(string $condition, string $operator, string $value): QueryBuilder;
    public function orderBy(string $column, string $direction = 'ASC'): QueryBuilder;
    public function limit(int $limit): QueryBuilder;
    public function getQuery(): string;
}