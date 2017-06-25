<?php

/**
 * Класс всего приложения
 * App::getDb()->select('...')
 */
class App
{
    private static $config;
    private static $db;

    /**
     * для получения пути до корневой директории всего проекта
     * @return string
     */
    public static function getRoot()                            //static - разрешает обращение к методу без создания экземпляра класса
    {
        return __DIR__ . '/../';                               //Возвращает корневую директорию проекта, т.к. по умолчанию на сервере настроена web как корневая
    }

    public static function getConfig()
    {
        // См. getDb. По аналогии
        if (self::$config === null) {
            self::$config = require(self::getRoot() . '/configs/main.php');
        }
        return self::$config;
    }

    public static function getDb()
    {
        $config = self::getConfig();
        // Нужно для того, чтобы если мы уже инициировали соединение, еще раз не инициировать,
        /// При повторном вызове этого метода в свойстве self::$db уже будет храниться наш объект
        if (self::$db === null) {
            // При создании нашего объекта автоматически в конструкторе проинициализируется соединение с PDO
            self::$db = new DataBase($config['db']['dsn'], $config['db']['username'], $config['db']['password']);
        }
        // При повторном вызове текущего метода, просто возвращаем ранее инициализированный объект класса DataBase
        return self::$db;
    }
}