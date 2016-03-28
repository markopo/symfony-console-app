<?php


namespace Acme;

use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;


class CompleteCommand extends \Acme\Command {



    protected function configure()
    {
        $this->setName('tasks:complete')
            ->setDescription('Complete a task')
            ->addArgument('id', InputArgument::REQUIRED);

    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $id = $input->getArgument('id');
        $this->databaseAdapater->query('delete from tasks where id = :id', compact('id'));

        $output->writeln('<info>Task completed!</info>');

        $this->showTasks($output);
    }
} 