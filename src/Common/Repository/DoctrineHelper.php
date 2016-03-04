<?php
namespace pdt256\article\Common\Repository;

use Doctrine;
use Doctrine\ORM\EntityManager;
use pdt256\article\Common\Repository\Doctrine\Functions\IfFunction;

class DoctrineHelper
{
    protected $eventManager;

    /** @var EntityManager */
    protected $entityManager;

    /** @var Doctrine\DBAL\Configuration */
    protected $entityManagerConfiguration;

    /** @var Doctrine\Common\Cache\CacheProvider */
    protected $cacheDriver;

    /** @var Doctrine\DBAL\Configuration */
    protected $config;

    public function __construct(Doctrine\Common\Cache\CacheProvider $cacheDriver = null)
    {
        $paths = [__DIR__ . '/../Entity'];
        $isDevMode = true;

        $this->config = Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration(
            $paths,
            $isDevMode,
            null,
            null,
            false
        );

        if ($cacheDriver !== null) {
            $this->cacheDriver = $cacheDriver;
            $this->config->setMetadataCacheImpl($this->cacheDriver);
            $this->config->setQueryCacheImpl($this->cacheDriver);
            $this->config->setResultCacheImpl($this->cacheDriver);
        }

        $this->eventManager = new Doctrine\Common\EventManager;

        $this->addMysqlFunctions();
    }

    public function clearCache()
    {
        $this->cacheDriver->deleteAll();
    }

    public function getCacheDriver()
    {
        return $this->cacheDriver;
    }

    public function getEntityManager()
    {
        return $this->entityManager;
    }

    public function setSqlLogger(Doctrine\DBAL\Logging\SQLLogger $sqlLogger)
    {
        $this->entityManagerConfiguration->setSQLLogger($sqlLogger);
    }

    public function setup(array $dbParams)
    {
        $this->entityManager = Doctrine\ORM\EntityManager::create($dbParams, $this->config, $this->eventManager);
        $this->entityManagerConfiguration = $this->entityManager->getConnection()->getConfiguration();
    }

    public function addSqliteFunctions()
    {
        /** @var Doctrine\DBAL\Driver\PDOConnection $pdo */
        $pdo = $this->entityManager->getConnection()->getWrappedConnection();
        $pdo->sqliteCreateFunction('if', function ($condition, $expr1, $expr2 = null) {
            return $condition ? $expr1 : $expr2;
        });
    }

    public function addMysqlFunctions()
    {
        $this->config->addCustomStringFunction('IF', function ($name) {
            return new IfFunction($name);
        });
    }
}
