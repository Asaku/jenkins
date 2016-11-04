<?php
/**
 * Created by PhpStorm.
 * Date: 07/05/2016
 * Time: 22:55
 */

$tickets = array();
$user = null;
$login = null;
$ticketsWithNoAdmin = array();

if (isset($_SESSION['login']))
    $login = $_SESSION['login'];

if($login){
    $user = $entityManager->find('\resources\Entities\User', $_SESSION['id']);
    $tickets = $ticketRepository->findBy(array('user' => $user));
    if ($user->getRole() == 'admin'){
        $ticketsWithNoAdmin = $entityManager->getRepository('resources\Entities\Ticket')->findBy(array('admin' => null));
        $tickets = $entityManager->getRepository('resources\Entities\Ticket')->findBy(array('status' => array('open', 'in_progress')));

        foreach($tickets as $key => $value){
            if($value->getAdmin() == null)
                unset($tickets[$key]);
        }
    }
}

echo $twig->render('index.html.twig', array('user' => $user, 'tickets' => $tickets, 'ticketsWithNoAdmin' => $ticketsWithNoAdmin));
