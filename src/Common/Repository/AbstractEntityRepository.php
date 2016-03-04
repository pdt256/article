<?php
namespace pdt256\article\common\Repository;

use Doctrine\ORM\EntityManager;

class AbstractEntityRepository
{
    /** @var EntityManager */
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    protected function getEntityManager()
    {
        return $this->entityManager;
    }
}
