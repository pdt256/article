<?php
namespace pdt256\article\RepositoryHydration\Repository;

class ResultSetMappingCompanyRepositoryTest extends AbstractDoctrineCompanyRepositoryTest
{
    public function setUp()
    {
        parent::setUp();
        $this->companyRepository = new ResultSetMappingCompanyRepository($this->entityManager);
    }
}
