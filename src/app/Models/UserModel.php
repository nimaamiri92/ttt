<?php

namespace App\Models;

class UserModel extends BaseModel
{
    protected string $table = 'user';

    public function getTableName():string
    {
        return $this->table;
    }
}
