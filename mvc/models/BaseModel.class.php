<?php
abstract class BaseModel
{
    private static $pdo;

    private static function setBdd()
    {
        self::$pdo = new PDO("mysql:host=localhost; dbname=projetphp;charset=utf8", 'root', '');
        self::$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
    }

    protected function getBdd()
    {
        if(self::$pdo === null)
        {
            self::setBdd();
        }
        return self::$pdo;
    }
}
?>