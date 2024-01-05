<?php

declare(strict_types = 1);

namespace ValanticSpryker\Client\SitemapStorage;

use Spryker\Client\Kernel\AbstractFactory;
use Spryker\Client\Storage\StorageClientInterface;
use Spryker\Service\Synchronization\SynchronizationServiceInterface;
use ValanticSpryker\Client\SitemapStorage\Mapper\SitemapStorageMapper;
use ValanticSpryker\Client\SitemapStorage\Mapper\SitemapStorageMapperInterface;
use ValanticSpryker\Client\SitemapStorage\Matcher\SitemapMatcher;
use ValanticSpryker\Client\SitemapStorage\Matcher\SitemapMatcherInterface;

class SitemapStorageFactory extends AbstractFactory
{
    /**
     * @return \ValanticSpryker\Client\SitemapStorage\Matcher\SitemapMatcherInterface
     */
    public function createSitemapMatcher(): SitemapMatcherInterface
    {
        return new SitemapMatcher(
            $this->getStorageClient(),
            $this->getSynchronizationService(),
            $this->createSitemapStorageMapper(),
        );
    }

    /**
     * @return \Spryker\Client\Storage\StorageClientInterface
     */
    public function getStorageClient(): StorageClientInterface
    {
        return $this->getProvidedDependency(SitemapStorageDependencyProvider::CLIENT_STORAGE);
    }

    /**
     * @return \Spryker\Service\Synchronization\SynchronizationServiceInterface
     */
    private function getSynchronizationService(): SynchronizationServiceInterface
    {
        return $this->getProvidedDependency(SitemapStorageDependencyProvider::SERVICE_SYNCHRONIZATION);
    }

    /**
     * @return \ValanticSpryker\Client\SitemapStorage\Mapper\SitemapStorageMapperInterface
     */
    private function createSitemapStorageMapper(): SitemapStorageMapperInterface
    {
        return new SitemapStorageMapper();
    }
}
