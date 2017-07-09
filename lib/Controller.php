<?php
namespace lib;

/*
 * Класс для "сборки" страниц сайта (соединения шаблона и представления)
 * Модификатор protected (защищенный) разрешает доступ наследуемым и родительским классам
 */
class Controller {
    //свойство $layout устанавливает шаблон (обертку) "main.php" для всех страниц (по умолчанию)
    protected $layout = 'main';
    //свойство $title устанавливает по умолчанию для всех страниц пустой title
    protected $title = '';
    //Функция, которая подключает файл представления, "обернутый" в шаблон (по умолчанию это шаблон main.php). Ппринимает имя файла с представлением (без расширения, с названием подпапки в папке views)
    protected function render($view, array $data = [])
    {
        echo \lib\App::getTwig()->render($view .'.twig', $data);
    }

    public function redirect($to = null, array $params = []) {
        $url = '/index.php';
        if (!empty($to)) {
            $params = array_merge(['r' => $to], $params);
        }
        if (!empty($params)) {
            // Склеиваем по стандарту URI, т.е. из массива получим такую строчку a=1&b=2
            $strParams = http_build_query($params);
            $url .= '?' . $strParams;
        }
        header("Location: $url");
        die;
    }

    public function getParam($name) {
        return App::getParam($name);
    }

    public function getParamGet($name) {
        return App::getParamGet($name);
    }
}