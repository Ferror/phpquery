<?php
declare(strict_types=1);

namespace Ferror\Bundle\PHPQuery\Presenter;

final class TimeTable
{
    /**
     * @var \Symfony\Component\Console\Helper\Table
     */
    private $table;

    /**
     * @var \Doctrine\DBAL\Logging\DebugStack
     */
    private $debugStack;

    public function __construct(\Symfony\Component\Console\Helper\Table $table, \Doctrine\DBAL\Logging\DebugStack $debugStack)
    {
        $table->setHeaders(['time']);

        $this->table = $table;
        $this->debugStack = $debugStack;
    }

    public function render(): void
    {
        $this->table->addRows(array_map(function ($query) {
            return [round($query['executionMS'], 4)];
        }, $this->debugStack->queries));
        $this->table->render();
    }
}
