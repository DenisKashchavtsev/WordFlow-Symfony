<?php

namespace App\Shared\Infrastructure\Symfony;

use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator as OrmPaginator;
use Exception;

class Paginator
{
    private OrmPaginator $ormPaginator;
    private ?int $resultCount = null;

    /**
     * @throws Exception
     */
    public function __construct(QueryBuilder $query, int $page, int $limit = 25)
    {
        $query = $query->setMaxResults($limit)
            ->setFirstResult(1 === $page ? 0 : ($page - 1) * $limit);

        $this->ormPaginator = new OrmPaginator($query, false);
    }

    public function getTotalPages(): int
    {
        return (int)ceil($this->getResultCount() / $this->ormPaginator->getQuery()->getMaxResults());
    }

    public function getResultCount(): int
    {
        if (is_null($this->resultCount)) {
            $this->resultCount = $this->ormPaginator->count();
        }

        return $this->resultCount;
    }

    public function getData(): array
    {
        return $this->ormPaginator->getIterator()->getArrayCopy();
    }
}