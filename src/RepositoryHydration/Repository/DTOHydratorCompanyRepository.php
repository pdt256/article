<?php
namespace pdt256\article\RepositoryHydration\Repository;

use Doctrine\ORM\EntityRepository;
use pdt256\article\RepositoryHydration\DTO\CompanyStatsDTO;

final class DTOHydratorCompanyRepository extends EntityRepository implements CompanyRepositoryInterface
{
    public function getCompanyStats(int $companyId): CompanyStatsDTO
    {
        $companyStatsList =  $this->getEntityManager()
            ->createQueryBuilder()
            ->select('NEW DTO:CompanyStatsDTO(
                SUM(IF(Employee.isActive=1,1,0)),
                SUM(IF(Employee.isActive=0,1,0))
            )')
            ->from('Entity:Employee', 'Employee')
            ->where('Employee.company = :companyId')
            ->setParameter('companyId', $companyId)
            ->getQuery()
            ->getResult();

        return $companyStatsList[0];
    }
}
