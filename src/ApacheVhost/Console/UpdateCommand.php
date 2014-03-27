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
            ->setDescription('Поиск и обновление виртуальных хостов.')
            ->addArgument(
               'search-dir',
               InputArgument::REQUIRED,
               'Директория поиска'
            )
            ->addArgument(
                'file-config',
                InputArgument::REQUIRED, //InputArgument::OPTIONAL,
                'Файл конфигурации'
            )
            ->addOption(
               'domain-prefix',
                null,
               InputOption::VALUE_REQUIRED,
               'Префикс к доменым именам'
            )
            ->addOption(
               'domain-suffix',
                null,
               InputOption::VALUE_REQUIRED,
               'Суффикс к доменым именам'
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