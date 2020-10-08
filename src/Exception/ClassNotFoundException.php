<?php
declare(strict_types=1);

namespace Ferror\Bundle\PHPQuery\Exception;

final class ClassNotFoundException extends \Exception
{
    public function __construct($className)
    {
        parent::__construct("Class $className not found");
    }
}
