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

    public function testGetCompanyStatsWithNoCompanyAndNoEmployees()
    {
        $companyStats = $this->companyRepository->getCompanyStats(1);

        $this->assertSame(0, $companyStats->totalActiveEmployees());
        $this->assertSame(0, $companyStats->totalInactiveEmployees());
    }

    public function testGetCompanyStatsWithNoEmployees()
    {
        $company = $this->getDummyActiveCompany();

        $this->entityManager->persist($company);
        $this->entityManager->flush();
        $this->entityManager->clear();

        $companyStats = $this->companyRepository->getCompanyStats($company->getId());

        $this->assertSame(0, $companyStats->totalActiveEmployees());
        $this->assertSame(0, $companyStats->totalInactiveEmployees());
    }

    public function testGetCompanyStats()
    {
        $companyId = $this->getCompanyIdForStatsTest();

        $companyStats = $this->companyRepository->getCompanyStats($companyId);

        $this->assertSame(2, $companyStats->totalActiveEmployees());
        $this->assertSame(1, $companyStats->totalInactiveEmployees());
    }

    private function getCompanyIdForStatsTest(): int
    {
        $company = $this->getDummyActiveCompany();

        $employee1 = $this->getDummyActiveEmployee($company, 1);
        $employee2 = $this->getDummyActiveEmployee($company, 2);
        $employee3 = $this->getDummyInactiveEmployee($company, 3);

        $this->entityManager->persist($company);
        $this->entityManager->persist($employee1);
        $this->entityManager->persist($employee2);
        $this->entityManager->persist($employee3);
        $this->entityManager->flush();
        $this->entityManager->clear();

        return $company->getId();
    }

    private function getDummyActiveCompany(): Company
    {
        $company = new Company;
        $company->setName('Acme');
        $company->setIsActive(true);

        return $company;
    }

    private function getDummyActiveEmployee(Company $company, int $num = 1): Employee
    {
        $employee = $this->getDummyEmployee($company, $num);
        $employee->setIsActive(true);

        return $employee;
    }

    private function getDummyInactiveEmployee(Company $company, int $num = 1): Employee
    {
        $employee = $this->getDummyEmployee($company, $num);
        $employee->setIsActive(false);

        return $employee;
    }

    private function getDummyEmployee(Company $company, int $num = 1): Employee
    {
        $employee = new Employee;
        $employee->setName('John Doe ' . $num);
        $employee->setCompany($company);

        return $employee;
    }
}
