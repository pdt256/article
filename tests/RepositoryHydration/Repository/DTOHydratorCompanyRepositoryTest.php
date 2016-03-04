<?php
namespace pdt256\article\RepositoryHydration\Repository;

class DTOHydratorCompanyRepositoryTest extends AbstractDoctrineCompanyRepositoryTest
{
    public function setUp()
    {
        parent::setUp();
        $this->companyRepository = new DTOHydratorCompanyRepository($this->entityManager);
    }
}
