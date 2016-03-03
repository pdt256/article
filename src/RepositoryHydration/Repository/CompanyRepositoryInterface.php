<?php
namespace pdt256\article\RepositoryHydration\Repository;

use pdt256\article\RepositoryHydration\DTO\CompanyStatsDTO;

interface CompanyRepositoryInterface
{
    /**
     * @param int $companyId
     * @return CompanyStatsDTO
     */
    public function getCompanyStats($companyId);
}
