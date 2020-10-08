<?php
declare(strict_types=1);

namespace Ferror\Bundle\PHPQuery;

final class QueryNamespace
{
    private $namespace;

    public function __construct($namespace)
    {
        $this->namespace = $namespace;
    }

    public function map()
    {
        $string = str_replace('\\', '/', $this->namespace);
        $array = str_split($string);

        if ('/' === $array[0]) {
            $array[0] = '';
        }

        if ('/' === $array[count($array) - 1]) {
            $array[count($array) - 1] = '';
        }

        return implode('', $array);
    }

    public function getClass($className)
    {
        return $this->namespace . $className;
    }
}
