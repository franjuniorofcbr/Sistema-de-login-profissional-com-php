<?php

// Configurações do banco de dados
$config = [
    'driver'   => 'mysql',
    'host'     => 'localhost',
    'dbname'   => 'login_mvc',
    'username' => 'root',
    'password' => '',
    'charset'  => 'utf8',
    'options'  => [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_PERSISTENT         => false,
    ],
];

// DSN (Data Source Name)
$dsn = sprintf(
    '%s:host=%s;dbname=%s;charset=%s',
    $config['driver'],
    $config['host'],
    $config['dbname'],
    $config['charset']
);

try {
    return new PDO($dsn, $config['username'], $config['password'], $config['options']);
} catch (PDOException $e) {
    // Em produção, logue o erro ao invés de exibir
    die('Erro ao conectar ao banco de dados.');
}
