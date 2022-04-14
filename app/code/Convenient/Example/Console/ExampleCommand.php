<?php
declare(strict_types=1);
namespace Convenient\Example\Console;

use Magento\Framework\Console\Cli;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use GuzzleHttp\Client;

class ExampleCommand extends Command
{
    private $guzzleClient;

    /**
     * Constructor
     *
     */
    public function __construct(Client $guzzleClient)
    {
        $this->guzzleClient = $guzzleClient;
        parent::__construct();
    }

    /**
     * Configure the command
     *
     * @return void
     */
    protected function configure()
    {
        $this->setName('convenient:example:example');
        $this->setDescription('Convenient example command');
        parent::configure();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Hello there this is my guzzle client ' . get_class($this->guzzleClient));
        return Cli::RETURN_SUCCESS;

    }
}
