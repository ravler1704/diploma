<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../lib/App.php';
spl_autoload_register('lib\App::registerAutoload');
// require_once library/Twig.php


/*if (!empty($_GET['r'])) {
    $r = $_GET['r'];
} else {
    $r = 'site/index';
}*/
//Присваиваем переменно r путь  'site/index' если массив $_GET['r'] пустой, иначе присваиваем переменной r содержание массива
$r = !empty($_GET['r']) ? $_GET['r'] : 'site/index';
//Делим строку в массиве $_GET['r'] по делителю "/"
// list($controllerName, $actionName) = explode('/', $r);
$arr = explode('/', $r);
$controllerName = $arr[0];
$actionName = $arr[1];

// $c == 'SiteController'
//Сохраняем в $c имя типа "SiteController"  ucfirst() - преобразует первый символ строки в верхний регистр
$c = 'controllers\\' . ucfirst($controllerName) . 'Controller';
//Создаем новый объект класса "ucfirst($controllerName) . 'Controller'"  и сохраняем его в $controller
$controller = new $c();
// $a == 'indexAction'
//Сохраняем в $a имя типа "indexAction"
$a = $actionName . 'Action';
//Выводим содержимое главной страницы (Вызываем метод типа "indexAction"  в класса типа "SiteController")
$controller->$a();
//$controller->render('...');                                                 //???????


