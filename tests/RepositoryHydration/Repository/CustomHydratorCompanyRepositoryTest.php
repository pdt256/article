<?php
namespace pdt256\article\RepositoryHydration\Repository;

class CustomHydratorCompanyRepositoryTest extends AbstractDoctrineCompanyRepositoryTest
{
    public function setUp()
    {
        parent::setUp();
        $this->companyRepository = new CustomHydratorCompanyRepository($this->entityManager);
    }
}
