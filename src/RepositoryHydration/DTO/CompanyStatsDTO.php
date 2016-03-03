<?php
namespace pdt256\article\RepositoryHydration\DTO;

class CompanyStatsDTO
{
    protected $totalActiveEmployees;
    protected $totalInactiveEmployees;

    public function __construct(int $totalActiveEmployees, int $totalInactiveEmployees)
    {
        $this->totalActiveEmployees = $totalActiveEmployees;
        $this->totalInactiveEmployees = $totalInactiveEmployees;
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
