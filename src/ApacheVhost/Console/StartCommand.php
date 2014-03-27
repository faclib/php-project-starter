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
    const NAME_PATTERN = '@^([A-Za-z0-9][A-Za-z0-9_.-]*)/([A-Za-z0-9][A-Za-z0-9_.-]+)$@';

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

    /**
     * @param string $dir
     *
     * @throws \RuntimeException
     * @throws \Symfony\Component\Filesystem\Exception\IOException
     */
    public function mkdir($dir)
    {
        if (!$this->fs->exists($dir)) {
            $this->fs->mkdir($dir, 0755);
        } else {
            throw new \RuntimeException('Directory exists: ' . $dir);
        }
    }

    /**
     * Copies a file from the template to the destination directory, replacing
     * all of the template variables.
     *
     * @param string $filename
     * @param string $dir
     * @param array $replacements
     *
     * @throws \RuntimeException
     * @throws \Symfony\Component\Filesystem\Exception\IOException
     */
    public function copy($filename, $dir, array $replacements = array())
    {
        $filepath = __DIR__ . '/../../../template/' . $filename;
        if (!is_file($filepath)) {
            throw new \RuntimeException('File not found: ' . $filename);
        }

        // Replace the variables in the template.
        $search = array_keys($replacements);
        $replace = array_values($replacements);
        $subject = file_get_contents($filepath);
        $filedata = str_replace($search, $replace, $subject);

        // Write the file.
        $target = $dir . '/' . $filename;
        $this->fs->touch($target);
        $this->fs->chmod($target, 0644);
        file_put_contents($target, $filedata);
    }

}
