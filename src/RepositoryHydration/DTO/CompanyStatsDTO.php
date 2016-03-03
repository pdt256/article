<?php
namespace pdt256\article\RepositoryHydration\DTO;

class CompanyStatsDTO
{
    /** @var int */
    protected $totalActiveEmployees;

    /** @var int */
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
