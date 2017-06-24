<?php
require_once __DIR__ . '/../lib/App.php';
require_once __DIR__ . '/../lib/Controller.php';
require_once __DIR__ . '/../controllers/SiteController.php';
require_once __DIR__ . '/../controllers/QuestionController.php';
require_once __DIR__ . '/../lib/View.php';

/*if (!empty($_GET['r'])) {
    $r = $_GET['r'];
} else {
    $r = 'site/index';
}*/
$r = !empty($_GET['r']) ? $_GET['r'] : 'site/index';                        //Присваиваем переменно r путь  'site/index' если массив $_GET['r'] пустой, иначе присваиваем переменной r содержание массива
// list($controllerName, $actionName) = explode('/', $r);                   //Делим строку в массиве $_GET['r'] по делителю "/"
$arr = explode('/', $r);
$controllerName = $arr[0];
$actionName = $arr[1];

// $c == 'SiteController'
$c = ucfirst($controllerName) . 'Controller';                               //Сохраняем в $c имя типа "SiteController"  ucfirst() - преобразует первый символ строки в верхний регистр
$controller = new $c();                                                     //Создаем новый объект класса "ucfirst($controllerName) . 'Controller'"  и сохраняем его в $controller
// $a == 'indexAction'
$a = $actionName . 'Action';                                                //Сохраняем в $a имя типа "indexAction"
$controller->$a();                                                          //Выводим содержимое главной страницы (Вызываем метод типа "indexAction"  в класса типа "SiteController")
//$controller->render('...');                                                 //???????


