<?php
namespace pdt256\article\RepositoryHydration\Repository;

class ManualHydratorCompanyRepositoryTest extends AbstractDoctrineCompanyRepositoryTest
{
    public function setUp()
    {
        parent::setUp();
        $this->companyRepository = new ManualHydratorCompanyRepository($this->entityManager);
    }
}
