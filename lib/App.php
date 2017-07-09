<?php
namespace lib;

use lib\database\DataBase;

/**
 * Класс всего приложения
 * App::getDb()->select('...')
 */
class App
{
    private static $config;
    private static $db;
    private static $twig;

    /**
     * для получения пути до корневой директории всего проекта
     * @return string
     */
    //static - разрешает обращение к методу без создания экземпляра класса
    public static function getRoot()
    {
        //Возвращает корневую директорию проекта, т.к. по умолчанию на сервере настроена web как корневая
        return __DIR__ . '/../';
    }

    public static function getConfig()
    {
        // По аналогии с getDb
        if (self::$config === null) {
            self::$config = require(self::getRoot() . 'configs/main.php');
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

    public static function registerAutoload($class)
    {
        // \lib\database\DataBase
        if (strpos($class, '\\') !== false) {
            $path = str_replace('\\', DIRECTORY_SEPARATOR, $class);
            require_once self::getRoot() . $path . '.php';
        }
    }

    public static function createUrl($route = null, array $params = [])
    {
        // $params = ['a' => 1, 'b' => 2];
        // index.php?a=1&b=2
        $url = 'index.php';
        if (!empty($route)) {
            // Помимо переданных параметров, мы еще должны добавить параметр r, например: r=site/create

            // $x = ['a' => 1]
            // $y = ['b' => 2]
            // $z = array_merge($y, $x)
            // $z == ['b' => 2, 'a' => 1]
            $params = array_merge(['r' => $route], $params);
        }
        if (!empty($params)) {
            // Склеиваем по стандарту URI, т.е. из массива получим такую строчку a=1&b=2
            $strParams = http_build_query($params);

            $url .= '?' . $strParams;
        }
        // index.php?r=site/index&a=1&b=2
        return $url;
    }

    public static function getParam($name)
    {
        if (isset($_REQUEST[$name])) {
            return $_REQUEST[$name];
        } else {
            return null;
        }
    }

    public static function getParamGet($name)
    {
        if (isset($_GET[$name])) {
            return $_GET[$name];
        } else {
            return null;
        }
    }

    /**
     * Возвращает данные авторизованного пользователя
     * @return null
     */
    public static function getUser()
    {
        if (!empty($_SESSION['user'])) {
            return $_SESSION['user'];
        }
        return null;
    }

    public static function initTwig($path)
    {
        $loader = new \Twig_Loader_Filesystem($path);
        $twig = new \Twig_Environment($loader, [
            //'cache' => '/path/to/compilation_cache',
        ]);

        $fnCreateUrl = function ($route = null, $params = []) {
            return App::createUrl($route, $params);
        };
        $function = new \Twig_Function('get_url', $fnCreateUrl);
        $twig->addFunction($function);

        $function = new \Twig_Function('get_user', function () {
            return \lib\App::getUser();
        });
        $twig->addFunction($function);


        //get_ParamId
        $getParamId = function () {
            return App::getParamGet('id');
        };

        $functionGPI = new \Twig_Function('get_ParamId', $getParamId);
        $twig->addFunction($functionGPI);

        //get_AllQuestionsCount
        $getAllQuestionsCount = function ($themeId = []) {
            //return $params;
            return App::getDb()->count('questions', ['theme_id' => $themeId]);
        };
        $functionAQC = new \Twig_Function('get_AllQuestionsCount', $getAllQuestionsCount);
        $twig->addFunction($functionAQC);

        //get_PublishedQuestionsCount
        $getPublishedQuestionsCount = function ($themeId = []) {
            //return $params;
            return App::getDb()->count('questions', ['status' => 'Опубликовано', 'theme_id' => $themeId]);
        };
        $functionPQC = new \Twig_Function('get_PublishedQuestionsCount', $getPublishedQuestionsCount);
        $twig->addFunction($functionPQC);

        //get_NoAnswerQuestionsCount
        $getNoAnswerQuestionsCount = function ($themeId = []) {
            //return $params;
            return App::getDb()->count('questions', ['theme_id' => $themeId, 'answer' => null]);
        };
        $functionNAC = new \Twig_Function('get_NoAnswerQuestionsCount', $getNoAnswerQuestionsCount);
        $twig->addFunction($functionNAC);


        self::$twig = $twig;
    }

    /**
     *
     * @return \Twig_Environment
     */
    public static function getTwig()
    {
        return self::$twig;
    }

}