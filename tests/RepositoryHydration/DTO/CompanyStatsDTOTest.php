<?php
namespace pdt256\article\RepositoryHydration\DTO;

use pdt256\article\tests\Helper\TestCase\ArticleTestCase;

class CompanyStatsDTOTest extends ArticleTestCase
{
    public function testConstruct()
    {
        $companyStatsDTO = new CompanyStatsDTO('1', 2);

        $this->assertSame(1, $companyStatsDTO->totalActiveEmployees());
        $this->assertSame(2, $companyStatsDTO->totalInActiveEmployees());
    }
}
