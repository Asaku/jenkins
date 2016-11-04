<?php
/**
 * Created by PhpStorm.
 * User: Asaku
 * Date: 08/05/2016
 * Time: 00:48
 */

require_once ('../bootstrap.php');

$loader = new Twig_Loader_Filesystem('../Views');
$twig = new Twig_Environment($loader, array(
    'cache' => false,
));