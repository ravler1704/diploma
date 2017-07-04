<?php
namespace controllers;

use lib\Controller;
use models\Themes;
use models\Questions;
/*
 * Контроллер для пользовательской части сайта. SiteController наследует все св-ва и методы Controller
 */
class SiteController extends Controller {
    //Функция вывода главной страницы
    public function indexAction()
    {
       //Присваиваем title 'Главная страница'
       $this->title = 'Главная страница';

       $themeModel = new Themes();
       $themes = $themeModel->select();

        $questionModel = new Questions();
        $questions = $questionModel->select();

       //Вызываем метод render() для главной страницы
       $this->render('site/index', ['themes' => $themes, 'questions' => $questions]);

    }





    //Функция записи вновь созданного вопроса в БД
    public function createQuestionAction()
    {
        //isset($_POST['...']);
        $pdo->execute('INSERT questions ....');
        //...
        $this->render('..');
    }
    //Функция вывода страницы "Об авторе"
    public function aboutAction()
    {
        $this->title = 'Об авторе';
        $this->render('site/about');
    }
}