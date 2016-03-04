<?php
namespace pdt256\article\RepositoryHydration\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use pdt256\article\RepositoryHydration\DTO\CompanyStatsDTO;
use pdt256\article\RepositoryHydration\Entity\Employee;

final class ResultSetMappingCompanyRepository extends EntityRepository implements CompanyRepositoryInterface
{
    public function getCompanyStats(int $companyId): CompanyStatsDTO
    {
        $resultSetMapping = new ResultSetMapping;
        $resultSetMapping
            ->addScalarResult('sclr_0', 'totalActiveEmployees', 'integer')
            ->addScalarResult('sclr_1', 'totalInactiveEmployees', 'integer');

        $companyStatsArray = $this->getEntityManager()
            ->createQueryBuilder()
            ->addSelect('SUM(IF(e.isActive=1,1,0)) AS totalActiveEmployees')
            ->addSelect('SUM(IF(e.isActive=0,1,0)) AS totalInactiveEmployees')
            ->from(Employee::class, 'e')
            ->where('e.company = :companyId')
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
