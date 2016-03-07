<?php
namespace pdt256\article\RepositoryHydration\Repository;

class CustomHydratorCompanyRepositoryTest extends AbstractDoctrineCompanyRepositoryTest
{
    protected function getCompanyRepository(): CompanyRepositoryInterface
    {
        return new CustomHydratorCompanyRepository($this->entityManager);
    }
}
