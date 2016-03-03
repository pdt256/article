<?php
namespace pdt256\article\RepositoryHydration\Repository;

use Doctrine\ORM\EntityRepository;
use pdt256\article\RepositoryHydration\DTO\CompanyStatsDTO;

class CustomHydratorCompanyRepository extends EntityRepository implements CompanyRepositoryInterface
{
    /**
     * @param int $companyId
     * @return CompanyStatsDTO
     */
    public function getCompanyStats($companyId)
    {
        $this->addCustomHydrationMode(CompanyStatsDTOHydrator::class);

        return $this->getEntityManager()
            ->createQueryBuilder()
            ->addSelect('SUM(IF(Employee.isActive=1,1,0)) AS totalActiveEmployees')
            ->addSelect('SUM(IF(Employee.isActive=0,1,0)) AS totalInactiveEmployees')
            ->from('Entity:Employee', 'Employee')
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
