<?php
$dsn = $_ENV["DATABASE_CONNECTION"];

if (!$dsn) {
    $dsn = $_ENV["DATABASE_PROTOCOL"] . ":host=" . $_ENV["DATABASE_HOST"] . ";port=" . $_ENV["DATABASE_PORT"] . ";dbName=" . $_ENV["DATABASE_NAME"];
}

return [
    'class' => 'yii\db\Connection',
    'dsn' => $dsn,
    'username' => $_ENV["DATABASE_USERNAME"],
    'password' => $_ENV["DATABASE_PASSWORD"],
    'charset' => 'utf8',
    'enableSchemaCache' => true,
    'schemaCacheDuration' => 60,
    'schemaCache' => 'cache',
];
