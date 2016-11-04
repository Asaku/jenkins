<?php
/**
 * Created by PhpStorm.
 * Date: 07/05/2016
 * Time: 22:55
 */
require_once('init.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    if ($_POST['update-ticket']){
        $ticket = $entityManager->find('\resources\Entities\Ticket', $_POST['update-ticket']);
        $ticket->setName($_POST['name']);
        $ticket->setStatus($_POST['status']);
        $ticket->setAdmin($userRepository->findOneBy(array('id' => intval($_POST['admin']))));
        $entityManager->persist($ticket);
        $entityManager->flush();
        header('Location: ../index.php');
    }else{
        $user = $entityManager->find('\resources\Entities\User', $_SESSION['id']);
        $ticket = new \resources\Entities\Ticket();
        $ticket->setName($_POST['name']);
        $ticket->setUser($user);

        $post = new \resources\Entities\Post();
        $post->setContent($_POST['content']);
        $post->setUser($user);
        $entityManager->persist($ticket);
        $entityManager->flush();

        $post->setTicket($ticket);
        $entityManager->persist($post);
        $entityManager->flush();
        header('Location: ../index.php');
    }
}

$ticket = null;
$users = array();
$posts = null;
if (isset($_GET['ticket'])){
    $ticket = $entityManager->find('\resources\Entities\Ticket', $_GET['ticket']);
    $users = $userRepository->findBy(array('role' => 'admin'));
    $posts = $postRepository->findBy(array('ticket' => $ticket));
}

echo $twig->render('ticket.html.twig', array(
    'ticket' => $ticket,
    'users' => $users,
    'posts' => $posts,
));
