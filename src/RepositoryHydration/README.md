# Doctrine Repository Hydration

## Abstract

## Introduction

## Related Work

## Outline The Body

## Body
<h3>Stringly-Typed Example</h3>

<p>
Suppose that you maintain a PHP web application that needs to expose meaningful company statistics to an administrative user. Think of how you might approach this problem. What SQL will you write? How will you separate your code with regards to the database and the UI?
</p>

<p>
Below is a typical solution using an MVC pattern with the Company Controller issuing a direct SQL query. For now lets focus on the UI code and how the interaction between the Controller and View layer impacts the overall maintainability.
</p>

<h5>Company Controller</h5>
[cc lang="php"]
class CompanyController
{
   public function view($companyId)
   {
      $sql = '
         SELECT
            SUM(IF(employee.isActive=1,1,0)) AS totalActiveEmployees,
            SUM(IF(employee.isActive=0,1,0)) AS totalInactiveEmployees
         FROM employee
         WHERE company_id = ' . (int) $companyId;

      $companyStats = $conn->query($sql);

      $this->setVar('companyStats', $companyStats);
      $this->setVar('company', ...);
   }
}
[/cc]

<h5>Company View</h5>
[cc lang="php"]
Company Name: ...
Active Employees: <?=$companyStats['totalActiveEmployees']?><br>
Inactive Employees: <?=$companyStats['totalInactiveEmployees']?>
[/cc]

<p>
Here, arrays and strings are used to access the domain object values. This <strong>stringly-typed<strong> nature tightly couples our UI layer with the repository layer. A small change to any of the strings will cause another part of the system to malfunction.
</p>

<p>
To reduce our dependence on strings, lets introduce a <strogn>Data Transfer Object</strong> (DTO) to strongly type these company statistics. This is a simple anemic PHP object with two getter methods.
</p>

[cc lang="php"]
class CompanyStatsDTO
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
[/cc]

<h5>Company View Using DTO Object</h5>
[cc lang="php"]
/** @var CompanyStatsDTO $companyStats */
Company Name: ...
Active Employees: <?=$companyStats->totalActiveEmployees()?><br>
Inactive Employees: <?=$companyStats->totalInactiveEmployees()?>
[/cc]

<p>
Now our UI layer only depends on the DTO object and not the Controller and SQL. Refactoring this object to rename or add new stats will be a safe operation. <strong>This object does one thing and is easy to test.</strong>
</p>

<p>
Now it is time to separate the repository layer from the controller. In doing so, we further remove our coupling to a relational database. Why should your Controller or View care that you are using a SQL database? First, we need an interface to code against.
</p>

<h5>Company Repository Interface</h5>
[cc lang="php"]
interface CompanyRepositoryInterface
{
    public function getCompanyStats(int $companyId): CompanyStatsDTO;
}
[/cc]

<p>
That was easy. Lets see how much simpler our controller becomes.
</p>

<h5>Controller Using Repository Layer</h5>
[cc lang="php"]
class CompanyController
{
   public function view($companyId)
   {
      $companyStats = $this->companyRepository->getCompanyStats($companyId);

      $this->setVar('companyStats', $companyStats);
      $this->setVar('company', ...);
   }
}
[/cc]

<p>
Ok. I get it. Separation of concerns. Single responsibility. How do I actually use this?
</p>

<p>
Lets look at four ways you can implement this Company Repository Interface using Doctrine.
</p>

<h3>Manual Hydrator</h3>

<p>
Below we implement the CompanyRepositoryInterface while using a Doctrine Query Builder. This helps to construct the same raw SQL query from before. Ignore the DQL language specifics for now and notice how we return a new CompanyStatsDTO object.
</p>

<h5>Manual Hydrator</h5>
[cc lang="php"]
class ManualHydratorCompanyRepository implements CompanyRepositoryInterface
{
    public function getCompanyStats(int $companyId): CompanyStatsDTO
    {
        $companyStatsArray = $this->getEntityManager()
            ->createQueryBuilder()
            ->addSelect('SUM(IF(Employee.isActive=1,1,0)) AS totalActiveEmployees')
            ->addSelect('SUM(IF(Employee.isActive=0,1,0)) AS totalInactiveEmployees')
            ->from(Employee::class, 'Employee')
            ->where('Employee.company = :companyId')
            ->setParameter('companyId', $companyId)
            ->setMaxResults(1)
            ->getQuery()
            ->getArrayResult();

        return new CompanyStatsDTO(
            (int) $companyStatsArray[0]['totalActiveEmployees'],
            (int) $companyStatsArray[0]['totalInactiveEmployees']
        );
    }
}
[/cc]

<p>
This is somewhat painful. Maybe there is another way to do the same thing. Lets try the Result Set Mapping strategy Doctrine provides.
</p>

<h3>Result Set Mapping Hydrator</h3>

[cc lang="php"]
class ResultSetMappingCompanyRepository implements CompanyRepositoryInterface
{
    public function getCompanyStats(int $companyId): CompanyStatsDTO
    {
        $resultSetMapping = new ResultSetMapping;
        $resultSetMapping
            ->addScalarResult('sclr_0', 'totalActiveEmployees', 'integer')
            ->addScalarResult('sclr_1', 'totalInactiveEmployees', 'integer');

        $companyStatsArray = $this->getEntityManager()
            ->createQueryBuilder()
            ->addSelect('SUM(IF(Employee.isActive=1,1,0)) AS totalActiveEmployees')
            ->addSelect('SUM(IF(Employee.isActive=0,1,0)) AS totalInactiveEmployees')
            ->from(Employee::class, 'Employee')
            ->where('Employee.company = :companyId')
            ->setParameter('companyId', $companyId)
            ->setMaxResults(1)
            ->getQuery()
            ->setResultSetMapping($resultSetMapping)
            ->getArrayResult();

        return new CompanyStatsDTO(
            $companyStatsArray[0]['totalActiveEmployees'],
            $companyStatsArray[0]['totalInactiveEmployees']
        );
    }
}
[/cc]

<p>
</p>

### Custom Hydrator
### DTO Hydrator

## Summary
