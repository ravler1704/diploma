<?php
namespace controllers;

use lib\Controller;
use models\Themes;
use models\Questions;

/*
 * Контроллер для вывода
 */
class SiteController extends Controller {
    //Функция вывода главной страницы
    public function indexAction()
    {
       $themeModel = new Themes();
       $themes = $themeModel->select();

        $questionModel = new Questions();
        $questions = $questionModel->select();

       //Вызываем метод render() для главной страницы
       $this->render('site/index', ['themes' => $themes, 'questions' => $questions]);
    }

}