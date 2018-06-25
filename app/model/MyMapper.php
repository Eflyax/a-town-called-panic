<?php declare(strict_types=1);

namespace App\Model;

use LeanMapper\DefaultMapper;
use LeanMapper\Exception\InvalidStateException;
use LeanMapper\Row;

class MyMapper extends DefaultMapper
{

    /** @var string */
    protected $defaultEntityNamespace = 'App\Model\Entity';

    public function getTableByRepositoryClass($repositoryClass)
    {
        $matches = [];
        if (preg_match('#([a-z0-9]+)repository$#i', $repositoryClass, $matches)) {
            $matches[1] = strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $matches[1]));
            return $matches[1];
        }
        throw new InvalidStateException('Cannot determine table name.');
    }

    public function getEntityClass($table, Row $row = null)
    {
        return $this->defaultEntityNamespace . '\\' . str_replace('_', '', ucwords($table, '_'));
    }

}
