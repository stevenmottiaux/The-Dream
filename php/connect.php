<?php

echo 'Hello, World!';

const DBHOST = 'DB';
CONST DBUSER = 'test';
const DBPASS = 'pass';
const DBNAME = 'demo';

$dsn = 'mysql:host=' . DBHOST . ';dbname=' . DBNAME;

try {
    $db = new PDO($dsn, DBUSER, DBPASS);
} catch (PDOException $exception) {
    echo 'Connection failed: ' . $exception->getMessage();
    die();
}