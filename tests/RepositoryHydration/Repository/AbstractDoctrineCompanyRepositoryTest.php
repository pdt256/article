<?php
namespace pdt256\article\RepositoryHydration\Repository;

use pdt256\article\RepositoryHydration\Entity\Company;
use pdt256\article\RepositoryHydration\Entity\Employee;
use pdt256\article\tests\Helper\TestCase\RepositoryTestCase;

abstract class AbstractDoctrineCompanyRepositoryTest extends RepositoryTestCase
{
    protected $metaDataClassNames = [
        Company::class,
        Employee::class,
    ];

    /** @var CompanyRepositoryInterface */
    protected $companyRepository;

    public function setUp()
    {
        parent::setUp();
        $this->companyRepository = $this->getCompanyRepository();
    }

    abstract protected function getCompanyRepository(): CompanyRepositoryInterface;

    public function testGetCompanyStats()
    {
        $company = $this->getDummyActiveCompany();

        $employee1 = $this->getDummyActiveEmployee(1, $company);
        $employee2 = $this->getDummyActiveEmployee(2, $company);
        $employee3 = $this->getDummyActiveEmployee(3, $company);
        $employee3->setIsActive(false);

        $this->entityManager->persist($company);
        $this->entityManager->persist($employee1);
        $this->entityManager->persist($employee2);
        $this->entityManager->persist($employee3);
        $this->entityManager->flush();
        $this->entityManager->clear();

        $companyStats = $this->companyRepository->getCompanyStats($company->getId());

        $this->assertSame(2, $companyStats->totalActiveEmployees());
        $this->assertSame(1, $companyStats->totalInactiveEmployees());
    }

    public function testGetCompanyStatsNoEmployees()
    {
        $company = $this->getDummyActiveCompany();

        $this->entityManager->persist($company);
        $this->entityManager->flush();
        $this->entityManager->clear();

        $companyStats = $this->companyRepository->getCompanyStats($company->getId());

        $this->assertSame(0, $companyStats->totalActiveEmployees());
        $this->assertSame(0, $companyStats->totalInactiveEmployees());
    }

    private function getDummyActiveCompany(): Company
    {
        $company = new Company;
        $company->setName('Acme');
        $company->setIsActive(true);

        return $company;
    }

    private function getDummyActiveEmployee(int $num = 1, Company $company = null): Employee
    {
        if ($company === null) {
            $company = $this->getDummyActiveCompany();
        }

        $employee = new Employee;
        $employee->setName('John Doe ' . $num);
        $employee->setIsActive(true);
        $employee->setCompany($company);

        return $employee;
    }
}
