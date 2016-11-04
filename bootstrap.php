<?php


use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

require_once "vendor/autoload.php";

include ('resources/Entities/User.php');
include ('resources/Entities/Ticket.php');
include ('resources/Entities/Post.php');

session_start();
$dbParams = array(
    'driver'   => 'pdo_mysql',
    'user'     => 'root',
    'password' => null,
    'dbname'   => 'ticket',
);

$config = Setup::createAnnotationMetadataConfiguration(array("resources/Entities"), false);
$entityManager = EntityManager::create($dbParams, $config);

$userRepository = $entityManager->getRepository('\resources\Entities\User');
$ticketRepository = $entityManager->getRepository('\resources\Entities\Ticket');
$postRepository = $entityManager->getRepository('\resources\Entities\Post');
