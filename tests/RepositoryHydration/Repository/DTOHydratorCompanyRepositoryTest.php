<?php
namespace pdt256\article\RepositoryHydration\Repository;

class DTOHydratorCompanyRepositoryTest extends AbstractDoctrineCompanyRepositoryTest
{
    protected function getCompanyRepository(): CompanyRepositoryInterface
    {
        return new DTOHydratorCompanyRepository($this->entityManager);
    }
}
