<?php
namespace Acme;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Created by PhpStorm.
 * User: marko
 * Date: 23/03/2016
 * Time: 09:45
 */

class SayHelloCommand extends Command {

    protected function configure() {

        $this->setName('sayhello')
             ->setDescription('Offer a greeting to the given person')
             ->addArgument('name', InputArgument::REQUIRED, 'Your name');

    }

    protected function execute(InputInterface $input, OutputInterface $output){

            $message = 'Hello, ' . $input->getArgument('name');
            $output->writeln("<info>{$message}</info>");

    }


} 