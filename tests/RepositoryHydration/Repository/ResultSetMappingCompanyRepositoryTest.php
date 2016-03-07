<?php
namespace pdt256\article\RepositoryHydration\Repository;

class ResultSetMappingCompanyRepositoryTest extends AbstractDoctrineCompanyRepositoryTest
{
    protected function getCompanyRepository(): CompanyRepositoryInterface
    {
        return new ResultSetMappingCompanyRepository($this->entityManager);
    }
}
