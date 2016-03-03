<?php
namespace pdt256\article\RepositoryHydration\Repository;

use pdt256\article\RepositoryHydration\DTO\CompanyStatsDTO;
use Doctrine\ORM\Internal\Hydration\AbstractHydrator;
use PDO;

class CompanyStatsDTOHydrator extends AbstractHydrator
{
    /**
     * @return CompanyStatsDTO
     */
    protected function hydrateAllData()
    {
        $row = $this->_stmt->fetch(PDO::FETCH_ASSOC);

        return new CompanyStatsDTO(
            $row['sclr_0'],
            $row['sclr_1']
        );
    }
}
