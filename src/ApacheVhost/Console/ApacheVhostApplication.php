<?php

namespace ApacheVhost\Console;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Filesystem\Filesystem;

class ApacheVhostApplication extends Application
{
    /**
     * @var \Symfony\Component\Filesystem\Filesystem
     */
    protected $fs;

    public function __construct(Filesystem $fs, $name = 'UNKNOWN', $version = '0.1')
    {
        $this->fs = $fs;
        parent::__construct($name, $version);
    }

    protected function getDefaultCommands()
    {
        $defaultCommands = parent::getDefaultCommands();
        // $defaultCommands[] = new StartCommand($this->fs);
        $defaultCommands[] = new UpdateCommand($this->fs);
        return $defaultCommands;
    }

    public function getDefinition()
    {
        $inputDefinition = parent::getDefinition();
        $inputDefinition->setArguments();
        return $inputDefinition;
    }

    protected function getCommandName(InputInterface $input)
    {
        return 'update';
    }

}
