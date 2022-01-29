<?php


abstract class Dao
{
    const DB_NAME = 'tq-twitter';
    const DB_HOST = 'localhost';
    const DB_USER = 'root';
    const DB_PASSWORD = 'root';

    protected $pdo;

    public function __construct()
    {
        $dsn = sprintf('mysql:charset=UTF8;dbname=%s;host=%s', self::DB_NAME, self::DB_HOST);

        $this->pdo = new PDO($dsn, self::DB_USER, self::DB_PASSWORD);
    }
}
