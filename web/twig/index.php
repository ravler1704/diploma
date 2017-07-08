<?php
use lib\App;

require_once __DIR__ . '/vendor/autoload.php';



$loader = new Twig_Loader_Filesystem(__DIR__ . '/vendor/templates');
$twig = new Twig_Environment($loader, array(
    //'cache' => '/path/to/compilation_cache',
));

$template = $twig->load('index.html');
$title = 'Название страницы';
echo $template->render(array(
    'title' => $title
));




$loader2 = new Twig_Loader_Filesystem(__DIR__ . '../../views/question');
$twig2 = new Twig_Environment($loader2, array(
    //'cache' => '/path/to/compilation_cache',
));
