<?php

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use app\container\ContainerClass;

require_once ("vendor/autoload.php");

$config = ORMSetup::createAttributeMetadataConfiguration(
    paths: array(__DIR__."/entity"),
    isDevMode: true,
);

$connection = DriverManager::getConnection([
    'user' => 'dbuser',
    'dbname' => 'university',
    'password' => 'password',
    'host' => '127.0.0.1',
    'driver' => 'pdo_mysql',
    'port'=> '3306',
    'charset' => 'UTF8'
], $config);

$entityManager = new EntityManager($connection, $config);

$container = new ContainerClass();
$container->set(EntityManager::class, $entityManager);
$controllerPath = __DIR__.'/controllers';