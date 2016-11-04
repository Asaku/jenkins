<?php

require_once ('bootstrap.php');

$loader = new Twig_Loader_Filesystem('Views');
$twig = new Twig_Environment($loader, array(
    'cache' => false,
));

include ('Controller/IndexController.php');
