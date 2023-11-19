<?php

namespace App\Core\Database\Drivers;

use App\Core\Config\ConfigFacade;
use \PDO;
use \PDOException;

class MysqlDriver implements DatabaseDriverInterface
{
    private ?PDO $pdo;
    private array $config;

    private $sql = '';

    private $binds = [];

    public function __construct(array $config)
    {
        $this->config = $config;
        $this->connect();
    }

    protected function connect()
    {
        $dsn = sprintf(
            "mysql:host=%s;dbname=%s;charset=%s",
            $this->config['host'],
            $this->config['database'],
            $this->config['charset'],
        );

        try {
            $this->pdo = new PDO(
                $dsn,
                $this->config['username'],
                $this->config['password']
            );

            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new \Exception('Database connection error');
        }
    }


    public function from(string $table, string $alias = null)
    {
        $alias = $alias ?? strtoupper($table);
        $this->sql .= "select * from $table As $alias";
        return $this;
    }

    public function where(string $column, string $value)
    {
        $rand = random_int(10, 1000);
        if (str_contains($this->sql, ' where ')) {
            $this->sql .= "and $column = :$rand ";
        } else {
            $this->sql .= " where $column = :$rand ";
        }

        $this->binds[] = [":$rand", $value];

        return $this;
    }

    public function limit(int $value)
    {
        $this->sql .= 'limit :value';
        $this->binds[] = [':value', $value];

        return $this;
    }

    public function offset(int $value)
    {
        $this->sql .= 'offset :value';
        $this->binds[] = [':value', $value];

        return $this;
    }

    public function save(string $table, array $values)
    {
        $stingKeys = implode(',', array_keys($values));
        $stringValues = ':' . implode(',:', array_keys($values));

        $this->sql .= "insert into $table ($stingKeys) values ($stringValues)";

        foreach ($values as $key => $value) {
            $this->binds[] = [":$key", $value];
        }

        return $this;
    }

    public function join(string $table,string $alias, string $condition, string $joinType = 'inner')
    {
        $this->sql .= "$joinType join $table on :condition ";

        $this->binds[] = [':condition', $condition];

        return $this;
    }

    public function dd()
    {
        $stmt = $this->pdo->prepare($this->sql);
        return $stmt->queryString;
    }
    public function exec()
    {
        $stmt = $this->pdo->prepare($this->sql);
        foreach ($this->binds as $bind) {
            $stmt->bindParam($bind[0], $bind[1]);
        }
        $stmt->execute();
        $this->clear();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    private function clear()
    {
        $this->sql = '';
        $this->binds = [];
    }
}
