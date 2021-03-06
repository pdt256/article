<?php
namespace pdt256\article\RepositoryHydration\Repository;

use pdt256\article\common\Repository\AbstractEntityRepository;
use pdt256\article\RepositoryHydration\DTO\CompanyStatsDTO;
use pdt256\article\RepositoryHydration\Entity\Employee;

final class DTOHydratorCompanyRepository extends AbstractEntityRepository implements CompanyRepositoryInterface
{
    public function getCompanyStats(int $companyId): CompanyStatsDTO
    {
        return $this->getEntityManager()
            ->createQueryBuilder()
            ->select('NEW ' . CompanyStatsDTO::class . '(
                SUM(IF(Employee.isActive=1,1,0)),
                SUM(IF(Employee.isActive=0,1,0))
            )')
            ->from(Employee::class, 'Employee')
            ->where('Employee.company = :companyId')
            ->setParameter('companyId', $companyId)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
