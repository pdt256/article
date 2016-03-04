<?php
namespace pdt256\article\RepositoryHydration\Entity;

use pdt256\article\tests\Helper\TestCase\EntityTestCase;

class EmployeeTest extends EntityTestCase
{
    public function testCreateDefaults()
    {
        $employee = new Employee;

        $this->assertSame(null, $employee->getName());
        $this->assertSame(false, $employee->isActive());
        $this->assertSame(null, $employee->getCompany());
    }

    public function testCreate()
    {
        $company = new Company;

        $employee = new Employee;
        $employee->setName('Acme');
        $employee->setIsActive(true);
        $employee->setCompany($company);

        $this->assertSame('Acme', $employee->getName());
        $this->assertSame(true, $employee->isActive());
        $this->assertSame($company, $employee->getCompany());
    }
}
