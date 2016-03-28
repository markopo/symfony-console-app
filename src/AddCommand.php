<?php
/**
 * Created by PhpStorm.
 * User: marko
 * Date: 28/03/2016
 * Time: 20:36
 */

namespace Acme;

use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;


class AddCommand extends \Acme\Command {



    protected function configure()
    {
        $this->setName('tasks:add')
             ->setDescription('Add task')
             ->addArgument('description', InputArgument::REQUIRED);

    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $description = $input->getArgument('description');
        $this->databaseAdapater->query('insert into tasks(description) values(:description)', compact('description'));

        $output->writeln('<info>Task added!</info>');

        $this->showTasks($output);
    }
} 