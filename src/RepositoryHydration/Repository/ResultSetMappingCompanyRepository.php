<?php
namespace pdt256\article\RepositoryHydration\Repository;

use Doctrine\ORM\Query\ResultSetMapping;
use pdt256\article\common\Repository\AbstractEntityRepository;
use pdt256\article\RepositoryHydration\DTO\CompanyStatsDTO;
use pdt256\article\RepositoryHydration\Entity\Employee;

final class ResultSetMappingCompanyRepository extends AbstractEntityRepository implements CompanyRepositoryInterface
{
    public function getCompanyStats(int $companyId): CompanyStatsDTO
    {
        $resultSetMapping = new ResultSetMapping;
        $resultSetMapping
            ->addScalarResult('sclr_0', 'totalActiveEmployees', 'integer')
            ->addScalarResult('sclr_1', 'totalInactiveEmployees', 'integer');

        $companyStatsArray = $this->getEntityManager()
            ->createQueryBuilder()
            ->addSelect('SUM(IF(Employee.isActive=1,1,0)) AS totalActiveEmployees')
            ->addSelect('SUM(IF(Employee.isActive=0,1,0)) AS totalInactiveEmployees')
            ->from(Employee::class, 'Employee')
            ->where('Employee.company = :companyId')
            ->setParameter('companyId', $companyId)
            ->setMaxResults(1)
            ->getQuery()
            ->setResultSetMapping($resultSetMapping)
            ->getArrayResult();

        return new CompanyStatsDTO(
            $companyStatsArray[0]['totalActiveEmployees'],
            $companyStatsArray[0]['totalInactiveEmployees']
        );
    }
}
