<?php
declare(strict_types=1);

namespace Ferror\Bundle\PHPQuery;

use Doctrine\DBAL\Connection;

final class Configuration
{
    private $connection;
    private $namespace;

    public function setConnection(Connection $connection): void
    {
        $this->connection = $connection;
    }

    public function getConnection()
    {
        return $this->connection;
    }

    public function setNamespace(string $string): void
    {
        $this->namespace = new \Ferror\Bundle\PHPQuery\QueryNamespace($string);
    }

    public function getNamespace()
    {
        return $this->namespace;
    }
}
