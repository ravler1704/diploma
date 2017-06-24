<?php

class QuestionController extends Controller                                 //Контроллер для административной части сайта. SiteController наследует все св-ва и метода Controller
{
    public function indexAction()
    {
        $this->render('question/index');
    }

    public function updateAction()
    {
        $this->render('question/update');
    }

    public function createAction()
    {
        $this->render('question/create');
    }

    public function deleteAction()
    {

    }

    public function loginAction()
    {
        $this->render('question/login');
    }

    public function adminPanelAction()
    {
        $this->render('question/adminPanel');
    }

}