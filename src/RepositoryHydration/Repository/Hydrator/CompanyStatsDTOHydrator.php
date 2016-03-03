<?php
namespace pdt256\article\RepositoryHydration\Repository\Hydrator;

use pdt256\article\RepositoryHydration\DTO\CompanyStatsDTO;
use Doctrine\ORM\Internal\Hydration\AbstractHydrator;
use PDO;

final class CompanyStatsDTOHydrator extends AbstractHydrator
{
    protected function hydrateAllData(): CompanyStatsDTO
    {
        $row = $this->_stmt->fetch(PDO::FETCH_ASSOC);

        return new CompanyStatsDTO(
            $row['sclr_0'],
            $row['sclr_1']
        );
    }
}
