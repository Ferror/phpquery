<?php
declare(strict_types=1);

namespace Ferror\Bundle\PHPQuery;

use Doctrine\DBAL\Connection;
use Ferror\Bundle\PHPQuery\Presenter\TimeTable;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Output\Output;

final class Application
{
    private $connection;
    private $output;
    private $sources;
    private $dir;

    public function __construct(Connection $connection, QueryNamespace $dir, array $sources, Output $output)
    {
        $this->connection = $connection;
        $this->dir = $dir;
        $this->sources = $sources;
        $this->output = $output;
    }

    public function run(): void
    {
        $configuration = $this->connection->getConfiguration();

        if ($configuration === null) {
            throw new \RuntimeException();
        }

        $stack = new \Doctrine\DBAL\Logging\DebugStack();
        $configuration->setSQLLogger($stack);
        $this->execute(new ProgressBar($this->output, count($this->sources)));
        $table = new TimeTable(new Table($this->output), $stack);
        $table->render();
    }

    private function execute(ProgressBar $progressBar): void
    {
        $progressBar->start();

        foreach ($this->sources as $query) {
            $progressBar->advance();

            $class = $this->dir->getClass($query);

            if (class_exists($class)) {
                $this->connection->executeQuery((new $class())->getSQL());
            }
        }

        $progressBar->finish();
        $this->output->writeln('');
    }
}
