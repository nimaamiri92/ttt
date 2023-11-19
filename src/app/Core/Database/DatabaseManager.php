<?php

namespace App\Core\Database;

use App\Core\Config\Config;
use App\Core\Database\Drivers\DatabaseDriverInterface;
use InvalidArgumentException;
use App\Core\Database\Drivers\MysqlDriver;
use App\Core\Database\Drivers\SqliteDatabaseDriver;


/**
 * Use Factory design pattern to build the objects
 */
class DatabaseManager
{
    private array $connections;
    private array $config;

    public function __construct()
    {
        $this->config = Config::get('database', 'connections');
    }

    public function connection($name = null): ?DatabaseDriverInterface
    {
        $connectionName = $name ?? Config::get('database', 'default');

        if (!isset($this->connections[$connectionName])) {
            $this->connections[$connectionName] = $this->makeConnection($connectionName);
        }

        return $this->connections[$connectionName];
    }

    protected function makeConnection($name): DatabaseDriverInterface
    {
        $config = $this->config[$name];

        // Create a new instance of the database connection based on the driver
        switch ($config['driver']) {
            case 'mysql':
                return new MysqlDriver($config);
            case 'sqlite':
                //dummy driver
                return new SqliteDatabaseDriver($config);
            default:
                throw new InvalidArgumentException("Driver {$config['driver']} not supported.");
        }
    }

}
