#!/usr/bin/env php
<?php
// application.php

require __DIR__.'/vendor/autoload.php';


use Acme\GreetCommand;
use Acme\SayHelloCommand;
use Symfony\Component\Console\Application;

$application = new Application('Markos command line tool', '0.0.1');

$application->add(new GreetCommand());
$application->add(new SayHelloCommand());
$application->add(new \Acme\NewCommand(new GuzzleHttp\Client));
$application->add(new \Acme\RenderCommand());

try {
    $pdo = new PDO('sqlite:db.sqlite');
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}
catch (Exception $exception) {
    echo 'Could not connect to the database';
    exit(1);
}

$dbAdapter = new \Acme\DatabaseAdapter($pdo);
$application->add(new \Acme\ShowCommand($dbAdapter));
$application->add(new \Acme\AddCommand($dbAdapter));
$application->add(new \Acme\CompleteCommand($dbAdapter)); 



$application->run();