<?php

/**
 * Created by PhpStorm.
 * Date: 07/05/2016
 * Time: 22:55
 */

require_once('init.php');

$admin = $userRepository->findOneBy(array('login' => $_SESSION['login']));
$tickets = $ticketRepository->findBy(array('admin' => $admin, 'status' => 'close'));

echo $twig->render('admin.html.twig', array('tickets' => $tickets));
