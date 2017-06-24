<?php

class SiteController extends Controller {                       //Контроллер для пользовательской части сайта. SiteController наследует все св-ва и методы Controller

    public function indexAction()                               //Функция вывода главной страницы
    {
       $this->title = 'Главная страница';                       //Присваиваем title 'Главная страница'
       $this->render('site/index');                             //Вызываем метод render() для главной страницы
    }

    public function createQuestionAction()                      //Функция записи вновь созданного вопроса в БД
    {
        //isset($_POST['...']);
        $pdo->execute('INSERT questions ....');
        //...
        $this->render('..');
    }

    public function aboutAction()                               //Функция вывода страницы "Об авторе"
    {
        $this->title = 'Об авторе';
        $this->render('site/about');
    }
}