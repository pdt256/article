<?php
namespace pdt256\article\RepositoryHydration\Repository;

class ManualHydratorCompanyRepositoryTest extends AbstractDoctrineCompanyRepositoryTest
{
    protected function getCompanyRepository(): CompanyRepositoryInterface
    {
        return new ManualHydratorCompanyRepository($this->entityManager);
    }
}
