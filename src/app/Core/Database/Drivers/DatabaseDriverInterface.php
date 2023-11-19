<?php

namespace App\Core\Database\Drivers;

interface DatabaseDriverInterface
{
    public function from(string $table, string $alias);

    public function where(string $column, string $value);

    public function join(string $table, string $alias, string $condition, string $joinType = 'inner');

    public function limit(int $value);

    public function offset(int $value);

    public function save(string $table, array $values);

    public function exec();
}
