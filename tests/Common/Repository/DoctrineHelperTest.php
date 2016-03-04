<?php
namespace pdt256\article\tests\Common\Repository;

use Doctrine;
use pdt256\article\Common\Repository\DoctrineHelper;
use pdt256\article\tests\Helper\TestCase\RepositoryTestCase;

class DoctrineHelperTest extends RepositoryTestCase
{
    protected $metaDataClassNames = [];

    public function testClearCache()
    {
        $doctrineHelper = new DoctrineHelper(new Doctrine\Common\Cache\ArrayCache);
        $doctrineHelper->setup([
            'driver'   => 'pdo_sqlite',
            'memory'   => true,
        ]);

        $cacheDriver = $doctrineHelper->getCacheDriver();
        $id = 'test-id';
        $data = 'test-data';
        $cacheDriver->save($id, $data);

        $this->assertSame($data, $cacheDriver->fetch($id));

        $doctrineHelper->clearCache();

        $this->assertSame(false, $cacheDriver->fetch($id));
    }

    public function testGetEntityManager()
    {
        $this->assertTrue($this->doctrineHelper->getEntityManager() instanceof Doctrine\ORM\EntityManager);
    }

    public function testSetupSqlLogger()
    {
        $this->doctrineHelper->setSqlLogger(new Doctrine\DBAL\Logging\EchoSQLLogger);
    }
}
