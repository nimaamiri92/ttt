<?php

namespace App\Core\Database\Drivers;

use App\Core\Config\ConfigFacade;
use \PDO;
use \PDOException;

class SqliteDatabaseDriver implements DatabaseDriverInterface
{
    public function from(string $table)
    {
        // TODO: Implement from() method.
    }

    public function where(string $column, string $value)
    {
        // TODO: Implement where() method.
    }

    public function join(string $table, string $condition, string $joinType = 'inner')
    {
        // TODO: Implement join() method.
    }

    public function limit(int $value)
    {
        // TODO: Implement limit() method.
    }

    public function offset(int $value)
    {
        // TODO: Implement offset() method.
    }

    public function save(string $table, array $values)
    {
        // TODO: Implement save() method.
    }

    public function exec()
    {
        // TODO: Implement exec() method.
    }
}
