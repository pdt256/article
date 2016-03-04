<?php
namespace pdt256\article\tests\Helper\TestCase;

use Doctrine\Common\Cache\ArrayCache;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\SchemaTool;
use pdt256\article\Common\Repository\DoctrineHelper;
use pdt256\article\tests\Helper\Repository\CountSQLLogger;

abstract class RepositoryTestCase extends ArticleTestCase
{
    /** @var EntityManager */
    protected $entityManager;

    /** @var DoctrineHelper */
    protected $doctrineHelper;

    /** @var CountSQLLogger */
    protected $countSQLLogger;

    /** @var string[] */
    protected $metaDataClassNames;

    public function setUp()
    {
        parent::setUp();
        if ($this->metaDataClassNames !== null) {
            $this->setupEntityManager();
        }
    }

    public function setCountLogger($enableDisplay = false)
    {
        $this->countSQLLogger = new CountSQLLogger($enableDisplay);
        $this->doctrineHelper->setSqlLogger($this->countSQLLogger);
    }

    public function getTotalQueries()
    {
        return $this->countSQLLogger->getTotalQueries();
    }

    protected function setupEntityManager($metaDataClassNames = null)
    {
        if ($metaDataClassNames !== null) {
            $this->metaDataClassNames = $metaDataClassNames;
        }

        $this->getConnection();
        $this->setupTestSchema();
    }

    private function getConnection()
    {
        $this->doctrineHelper = new DoctrineHelper(new ArrayCache);
        $this->doctrineHelper->setup([
            'driver' => 'pdo_sqlite',
            'memory' => true,
        ]);
        $this->doctrineHelper->addSqliteFunctions();

        $this->entityManager = $this->doctrineHelper->getEntityManager();
    }

    private function setupTestSchema()
    {
        if ($this->metaDataClassNames === null) {
            $classes = $this->entityManager->getMetaDataFactory()->getAllMetaData();
        } else {
            $classes = [];
            foreach ($this->metaDataClassNames as $className) {
                $classes[] = $this->entityManager->getMetaDataFactory()->getMetadataFor($className);
            }
        }

        $tool = new SchemaTool($this->entityManager);
        $tool->createSchema($classes);
    }
}
