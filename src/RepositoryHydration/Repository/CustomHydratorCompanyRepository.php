<?php
namespace pdt256\article\RepositoryHydration\Repository;

use Doctrine\ORM\EntityRepository;
use pdt256\article\RepositoryHydration\DTO\CompanyStatsDTO;
use pdt256\article\RepositoryHydration\Entity\Employee;
use pdt256\article\RepositoryHydration\Repository\Hydrator\CompanyStatsDTOHydrator;

final class CustomHydratorCompanyRepository extends EntityRepository implements CompanyRepositoryInterface
{
    public function getCompanyStats(int $companyId): CompanyStatsDTO
    {
        $this->addCustomHydrationMode(CompanyStatsDTOHydrator::class);

        return $this->getEntityManager()
            ->createQueryBuilder()
            ->addSelect('SUM(IF(e.isActive=1,1,0)) AS totalActiveEmployees')
            ->addSelect('SUM(IF(e.isActive=0,1,0)) AS totalInactiveEmployees')
            ->from(Employee::class, 'e')
            ->where('e.company = :companyId')
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
