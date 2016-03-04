<?php
namespace pdt256\article\RepositoryHydration\DTO;

final class CompanyStatsDTO
{
    protected $totalActiveEmployees;
    protected $totalInactiveEmployees;

    public function __construct(int $totalActiveEmployees = null, int $totalInactiveEmployees = null)
    {
        $this->totalActiveEmployees = (int) $totalActiveEmployees;
        $this->totalInactiveEmployees = (int) $totalInactiveEmployees;
    }

    public function totalActiveEmployees(): int
    {
        return $this->totalActiveEmployees;
    }

    public function totalInactiveEmployees(): int
    {
        return $this->totalInactiveEmployees;
    }
}
