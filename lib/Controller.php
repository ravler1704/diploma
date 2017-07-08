<?php
namespace lib;
/*
 * Модификатор protected (защищенный) разрешает доступ наследуемым и родительским классам
 * Класс для "сборки" страниц сайта (соединения шаблона и представления)
 */

class Controller {
    //свойство $layout устанавливает шаблон (обертку) "main.php" для всех страниц (по умолчанию)
    protected $layout = 'main';
    //свойство $title устанавливает по умолчанию для всех страниц пустой title
    protected $title = '';
    //Функция, которая подключает файл представления, "обернутый" в шаблон (по умолчанию это шаблон main.php). Ппринимает имя файла с представлением (без расширения, с названием подпапки в папке views)
    protected function render($view, array $data = [])
    {
        extract($data);
        //Сохраням в переменную $title тег title конкретного объекта (по умолчанию тег title пустой)
        $title = $this->title;
        //Сохраняем в переменную $viewPath имя путь до представления. Вызываем метод getRoot() класса App , тем самым получаем путь до корневого каталога и прибавляем к нему путь до представления имени файла представления $view        :: Позволяет обращаться к статическим свойствам, константам и переопределенным свойствам или методам класса. При обращении к этим элементам извне класса, необходимо использовать имя этого класса
        $viewPath = App::getRoot() . 'views/' . $view . '.php';
        //Сохраняем в переменную $content код, содержащийся в файле, имеющем путь $viewPath. Что было бы если второй аргумент был бы false ??????
        $content = View::renderFile($viewPath, $data, true);

        //Подключаем файл шаблона (слоя), с именем, соответствующим имени свойства в конкретном объекте (по умолчанию это .../views/layouts/main.php)
        require App::getRoot() . 'views/layouts/' . $this->layout . '.php';

        //twig
        /*
        $loader = new Twig_Loader_Filesystem(App::getRoot() . 'web/index.php');
        $twig = new Twig_Environment($loader, array(
            //'cache' => '/path/to/compilation_cache',
        ));

        $template = $twig->load($view);
        $template->display(array( $vars ));
        */
        //twig
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