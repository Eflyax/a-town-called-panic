<?php declare(strict_types=1);

namespace App\Model\Repository;

use Dibi\Exception;
use LeanMapper\Connection;
use LeanMapper\Events;
use LeanMapper\IEntityFactory;
use LeanMapper\IMapper;

abstract class BaseRepository extends \LeanMapper\Repository
{

    /**
     * @param Connection $connection
     * @param IMapper $mapper
     * @param IEntityFactory $entityFactory
     */
    public function __construct(Connection $connection, IMapper $mapper, IEntityFactory $entityFactory)
    {
        parent::__construct($connection, $mapper, $entityFactory);
        $this->connection = $connection;
        $this->mapper = $mapper;
        $this->entityFactory = $entityFactory;
        $this->events = new Events;
        $this->initEvents();
    }

    public function getDataSource()
    {
        return $this->connection
            ->select('*')
            ->from($this->getTable());
    }

    public function findOneBy($criterias)
    {
        $row = $this->connection
            ->select('*')
            ->from($this->getTable());

        foreach ($criterias as $key => $value) {
            if (is_array($value)) {
                throw new Exception('Value can\'t be array');
            }
            $row->where($key . ' = %s', $value);
        }

        if ($finalRow = $row->fetch()) {
            return $this->createEntity($finalRow);
        }

        return null;
    }

    public function findByIds(array $ids)
    {
        return $this->createEntities(
            $this->connection->select('*')
                ->from($this->getTable())
                ->where('id IN (?)', $ids)
                ->fetchAll()
        );
    }

    public function findBy($criterias, $order = [], $limit = null, $offset = null)
    {
        $rows = $this->connection
            ->select('*')
            ->from($this->getTable());

        foreach ($criterias as $key => $value) {
            if (is_array($value)) {
                throw new Exception('Value can\'t be array');
            }
            $rows->where($key . ' = %s', $value);
        }

        if (is_integer($limit)) {
            $rows->limit($limit);
        }

        if (is_integer($offset)) {
            $rows->offset($offset);
        }

        if ($order) {
            $rows->orderBy($order);
        }

        return $this->createEntities($rows->fetchAll());
    }

    public function find($id)
    {
        $row = $this->connection->select('*')
            ->from($this->getTable())
            ->where('id = %i', $id)
            ->fetch();

        if ($row === false) {
            return null;
        }

        return $this->createEntity($row);
    }

    public function findAll()
    {
        return $this->createEntities(
            $this->connection->select('*')
                ->from($this->getTable())
                ->fetchAll()
        );
    }

}