<?php

return static function(\Ferror\Bundle\PHPQuery\Configuration $configuration) {
    $configuration->setConnection(
        \Doctrine\DBAL\DriverManager::getConnection([
            'dbname' => 'landingi',
            'user' => 'root',
            'password' => '1234',
            'host' => 'localhost:3306',
            'driver' => 'pdo_mysql',
        ])
    );
    $configuration->setNamespace('Application\\Query\\');
};
