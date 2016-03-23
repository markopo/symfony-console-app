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

$application->run();