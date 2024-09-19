<?php

class Connection 
{
    private static PDO $instance;

    private static function getInstance(): object
    {
        if (!isset(self::$instance) or empty(self::$instance)) { 
            try {
                self::$instance = new PDO(
                    'mysql:host='.DB_HOST.';dbname='.DB_NAME, 
                    DB_USER, 
                    DB_PASS, 
                    [
                        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
                    ]
                );
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            }
            catch (PDOException $error) {
                show500($error);
            }
        }
        
        return self::$instance;
    }

    public static function prepare(string $query, array $options = []): PDOStatement|false
    {
        return self::getInstance()->prepare($query, $options);
    }

    public static function exec(string $statement): int|false
    {
        return self::getInstance()->exec($statement);
    }

    public static function query(string $query, ?int $fetchMode = null): PDOStatement|false
    {
        return self::getInstance()->query($query, $fetchMode);
    }

    public static function lastInsertId(): string|false
    {
        return self::getInstance()->lastInsertId();
    }

    public static function quote(string $string, int $type = PDO::PARAM_STR): string|false
    {
        return self::getInstance()->quote($string, $type);
    }

    public static function beginTransaction(): bool
    {
        return self::getInstance()->beginTransaction();
    }

    public static function rollBack(): bool
    {
        return self::getInstance()->rollBack();
    }

    public static function commit(): bool
    {
        return self::getInstance()->commit();
    }
}
