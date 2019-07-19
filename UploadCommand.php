<?php

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

require_once  './UploadAssets.php';

class UploadCommand extends Command
{
    protected $commandName = 'cloud:upload';

    protected $commandDescription = "This will run your UploadAssets class";

    protected function configure()
    {
        $this->setName($this->commandName)->setDescription($this->commandDescription);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
	new UploadAssets; 
    }
}
