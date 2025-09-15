<?php

require_once __DIR__ . '/QueryBuilder.php';

class Director
{
    private $builder;

    public function __construct(QueryBuilder $builder)
    {
        $this->builder = $builder;
    }

    public function getActiveUsers(): string
    {
        return $this->builder
            ->select(['name', 'email'])
            ->where('status', '=', 'active')
            ->orderBy('created_at', 'DESC')
            ->limit(10)
            ->getQuery();
    }
}