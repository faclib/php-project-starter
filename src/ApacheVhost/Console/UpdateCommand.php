<?php
/**
 * UpdateCommand class  - UpdateCommand.php file
 *
 * @author     Dmitriy Tyurin <fobia3d@gmail.com>
 * @copyright  Copyright (c) 2014 Dmitriy Tyurin
 */

namespace ApacheVhost\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;

/**
 * UpdateCommand class
 *
 * @package   App
 */
class UpdateCommand extends Command
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
            ->setName('update')
            ->setDescription('Start a new PHP project.')
            ->addArgument(
               'search',
               InputArgument::REQUIRED,
               'The project\'s name in vendor/project format'
            )
            ->addOption(
               'domain-prefix',
                null,
               InputOption::VALUE_REQUIRED,
               'The project\'s display name, e.g. "My Project", defaults to the project name'
            )
            ->addOption(
               'domain-suffix',
                null,
               InputOption::VALUE_REQUIRED,
               'The project\'s display name, e.g. "My Project", defaults to the project name'
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
        //$projectName = $input->getArgument('search');
        print_r($input);
    }

}