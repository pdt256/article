<?php
namespace pdt256\article\RepositoryHydration\Repository;

use pdt256\article\RepositoryHydration\DTO\CompanyStatsDTO;

interface CompanyRepositoryInterface
{
    public function getCompanyStats(int $companyId): CompanyStatsDTO;
}
