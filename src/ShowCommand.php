<?php
/**
 * Created by PhpStorm.
 * User: marko
 * Date: 27/03/2016
 * Time: 17:32
 */

namespace Acme;

use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;


class ShowCommand extends \Acme\Command {



    protected function configure()
    {
        $this->setName('tasks:show')
             ->setDescription('Show all tasks');

    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $this->showTasks($output);
    }


} 