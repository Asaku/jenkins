<?php

/**
 * Created by PhpStorm.
 * Date: 07/05/2016
 * Time: 22:55
 */

require_once('init.php');

if (isset($_GET['action'])){
    $user = new \resources\Entities\User();

    $passOne = $_POST['password'];
    $passTwo = $_POST['password_verification'];
    $user->setPassword($passOne, $passTwo);

    $user->setLogin($_POST['login']);

    $entityManager->persist($user);
    $entityManager->flush();

    session_start();
    $_SESSION['id'] = $user->getId();
    $_SESSION['login'] = $user->getLogin();

    header('Location: ../index.php');
}

if (isset($_POST['action-login'])){
    $user = $userRepository->findOneBy(array('login' => $_POST['login']));

    if ($user == null)
        die('mauvaise mdp');

    if ($user->checkPassword($_POST['password'])){
        $_SESSION['login'] = $user->getLogin();
        $_SESSION['id'] = $user->getId();
        $_SESSION['role'] = $user->getRole();
    }

    header('Location: ../index.php');
}



echo $twig->render('user.html.twig', array());
