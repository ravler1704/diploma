<?php
                                                                                    // Модификатор protected (защищенный) разрешает доступ наследуемым и родительским классам
class Controller {                                                                  //Класс для "сборки" страниц сайта (соединения шаблона и представления)
    protected $layout = 'main';                                                     //свойство $layout устанавливает шаблон (обертку) "main.php" для всех страниц (по умолчанию)
    protected $title = '';                                                          //свойство $title устанавливает по умолчанию для всех страниц пустой title

    protected function render($view)                                                //Функция, которая подключает файл представления, "обернутый" в шаблон (по умолчанию это шаблон main.php). Ппринимает имя файла с представлением (без расширения, с названием подпапки в папке views)
    {
        $title = $this->title;                                                      //Сохраням в переменную $title тег title конкретного объекта (по умолчанию тег title пустой)
        $viewPath = App::getRoot() . 'views/' . $view . '.php';                     //Сохраняем в переменную $viewPath имя путь до представления. Вызываем метод getRoot() класса App , тем самым получаем путь до корневого каталога и прибавляем к нему путь до представления имени файла представления $view        :: Позволяет обращаться к статическим свойствам, константам и переопределенным свойствам или методам класса. При обращении к этим элементам извне класса, необходимо использовать имя этого класса
        $content = View::renderFile($viewPath, true);                               //Сохраняем в переменную $content код, содержащийся в файле, имеющем путь $viewPath. Что было бы если второй аргумент был бы false ??????
        require App::getRoot() . 'views/layouts/' . $this->layout . '.php';         //Подключаем файл шаблона (слоя), с именем, соответствующим имени свойства в конкретном объекте (по умолчанию это .../views/layouts/main.php)
    }
}