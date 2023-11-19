<?php

namespace App\Models;

use App\Core\Database\DatabaseManager;
use App\Core\Database\Drivers\DatabaseDriverInterface;

abstract class BaseModel
{
    private DatabaseDriverInterface $db;

    public function __construct(DatabaseManager $databaseManager)
    {
        $this->db = $databaseManager->connection();
    }

    abstract public function getTableName(): string;

    public function findById(int $id)
    {
        return $this->db->from($this->getTableName(), strtoupper($this->getTableName()))->where('id', $id)->exec();
    }

    public function find(array $where)
    {
        $this->db->from($this->getTableName());
        foreach ($where as $column => $value) {
            $this->db->where($column, $value);
        }
        return $this->db->exec();
    }

    public function create(array $values)
    {
        $this->db->save($this->getTableName(), $values)->exec();
    }

}
