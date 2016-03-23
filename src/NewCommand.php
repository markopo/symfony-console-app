<?php
/**
 * Created by PhpStorm.
 * User: marko
 * Date: 23/03/2016
 * Time: 10:21
 */

namespace Acme;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputInterface;
use GuzzleHttp\ClientInterface;
use ZipArchive;

class NewCommand extends Command {

    private $client;

    private $url = 'http://cabinet.laravel.com/latest.zip';

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;

        parent::__construct();
    }

    protected function configure() {

        $this->setName('new')
            ->setDescription('Create a laravel application')
            ->addArgument('name', InputArgument::REQUIRED);

    }

    protected function execute(InputInterface $input, OutputInterface $output){

            $directory = getcwd() . '/' . $input->getArgument('name');

            $this->assertApplicationDoesNotExist($directory, $output);

            $zipFile = $this->makeFileName();
            $this->download($zipFile)
                 ->extract($zipFile, $directory)
                 ->cleanUp($zipFile);

            $output->writeln('<comment>Application ready!!</comment>');

    }

    private function makeFileName() {
        return getcwd() . '/laravel_' . md5(time().uniqid()) . '.zip';
    }

    private function assertApplicationDoesNotExist($directory, OutputInterface $output) {
        if(is_dir($directory)) {
            $output->writeln('Application already exists!');
            exit(1);
        }
    }

    private function download($zipFile) {
        $response = $this->client->get($this->url)->getBody();
        file_put_contents($zipFile, $response);

        return $this;
    }

    private function extract($zipFile, $directory) {
        $archive = new ZipArchive();
        $archive->open($zipFile);
        $archive->extractTo($directory);
        $archive->close();

        return $this;
    }

    private function cleanUp($zipFile){
        @chmod($zipFile, 0777);
        @unlink($zipFile);
        return $this;
    }


} 