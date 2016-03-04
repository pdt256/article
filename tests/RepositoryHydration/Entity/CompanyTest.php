<?php
namespace pdt256\article\RepositoryHydration\Entity;

use pdt256\article\tests\Helper\TestCase\EntityTestCase;

class CompanyTest extends EntityTestCase
{
    public function testCreateDefaults()
    {
        $company = new Company;

        $this->assertSame(null, $company->getId());
        $this->assertSame(null, $company->getName());
        $this->assertSame(false, $company->isActive());
    }

    public function testCreate()
    {
        $company = new Company;
        $company->setName('Acme');
        $company->setIsActive(true);

        $this->assertSame('Acme', $company->getName());
        $this->assertSame(true, $company->isActive());
    }
}
