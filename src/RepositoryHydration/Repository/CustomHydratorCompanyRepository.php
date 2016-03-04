<?php
namespace pdt256\article\RepositoryHydration\Repository;

use pdt256\article\common\Repository\AbstractEntityRepository;
use pdt256\article\RepositoryHydration\DTO\CompanyStatsDTO;
use pdt256\article\RepositoryHydration\Entity\Employee;
use pdt256\article\RepositoryHydration\Repository\Hydrator\CompanyStatsDTOHydrator;

final class CustomHydratorCompanyRepository extends AbstractEntityRepository implements CompanyRepositoryInterface
{
    public function getCompanyStats(int $companyId): CompanyStatsDTO
    {
        $this->addCustomHydrationMode(CompanyStatsDTOHydrator::class);

        return $this->getEntityManager()
            ->createQueryBuilder()
            ->addSelect('SUM(IF(Employee.isActive=1,1,0)) AS totalActiveEmployees')
            ->addSelect('SUM(IF(Employee.isActive=0,1,0)) AS totalInactiveEmployees')
            ->from(Employee::class, 'Employee')
            ->where('Employee.company = :companyId')
            ->setParameter('companyId', $companyId)
            ->setMaxResults(1)
            ->getQuery()
            ->getResult(CompanyStatsDTOHydrator::class);
    }

    protected function addCustomHydrationMode(string $className)
    {
        $this->getEntityManager()->getConfiguration()->addCustomHydrationMode(
            $className,
            $className
        );
    }
}
