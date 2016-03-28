<?php
/**
 * Created by PhpStorm.
 * User: marko
 * Date: 23/03/2016
 * Time: 13:59
 */

namespace Acme;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RenderCommand extends Command {

    public function configure() {

        $this->setName('render')->setDescription('Render some tabular data');

    }

    public function execute(InputInterface $input, OutputInterface $output) {

        $table = new Table($output);

        $table->setHeaders([ 'Name', 'Age' ])
              ->setRows([
                  [ 'Marko', 39 ],
                  [ 'Linda', 35 ],
                  [ 'Alice', 9 ],
                  [ 'Linda', 3 ]
              ])->render();

    }

} 