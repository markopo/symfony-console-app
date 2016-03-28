<?php
/**
 * Created by PhpStorm.
 * User: marko
 * Date: 28/03/2016
 * Time: 20:39
 */

namespace Acme;

use \Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command;

class Command extends SymfonyCommand {

    protected  $databaseAdapater;


    public function __construct(DatabaseAdapter $databaseAdapter)
    {
        $this->databaseAdapater = $databaseAdapter;

        parent::__construct();
    }



    protected function showTasks($output) {

        $tasks = $this->databaseAdapater->fetchAll('tasks');

        if(!$tasks) {
            return $output->writeln('<info>No tasks at the moment!</info>');
        }



        $table = new Table($output);


        $table->setHeaders([ 'Id', 'Description' ])
            ->setRows($tasks)
            ->render();
    }

} 