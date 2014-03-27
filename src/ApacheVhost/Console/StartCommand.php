<?php

namespace ApacheVhost\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;

class StartCommand extends Command
{

    /**
     * @var \Symfony\Component\Filesystem\Filesystem
     */
    protected $fs;

    public function __construct(Filesystem $fs, $name = null)
    {
        $this->fs = $fs;
        parent::__construct($name);
    }

    protected function configure()
    {
        $this
            ->setName('start')
            ->setDescription('Start a new PHP project.')
            ->addArgument(
               'project-name',
               InputArgument::REQUIRED,
               'The project\'s name in vendor/project format'
            )
            ->addArgument(
                'directory',
                InputArgument::OPTIONAL,
                'The directory the PHP project is being started in, defaults to a directory named after the project'
            )
            ->addOption(
               'jenkins-url',
                null,
               InputOption::VALUE_REQUIRED,
               'The URL of the Jenkins server that the job will be created on'
            )
            ->addOption(
               'no-repo',
                null,
               InputOption::VALUE_NONE,
               'Don\'t create the Git repository'
            )
        ;
    }

    /**
     * @{inheritdoc}
     *
     * @throws \RuntimeException
     * @throws \GitWrapper\GitException
     * @throws \Symfony\Component\Filesystem\Exception\IOException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // $projectName = $input->getArgument('project-name');
        
    }

}
