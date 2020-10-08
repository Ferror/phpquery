<?php
declare(strict_types=1);

namespace Ferror\Bundle\PHPQuery;

use PHPUnit\Framework\TestCase;

final class QueryNamespaceTest extends TestCase
{
    public function testItMapsNamespaceToPhysicalAddress(): void
    {
        $namespace = new QueryNamespace('\\Application\\Query\\');
        self::assertEquals('Application/Query', $namespace->map());
    }

    public function testItGetsClass()
    {
        $namespace = new QueryNamespace('\\Application\\Query\\');
        self::assertEquals('\\Application\\Query\\QueryClass', $namespace->getClass('QueryClass'));
    }
}
