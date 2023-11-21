<?php

declare(strict_types = 1);

namespace ValanticSpryker\Client\SitemapStorage\Matcher;

use Generated\Shared\Transfer\SitemapRequestTransfer;
use Generated\Shared\Transfer\SitemapResponseTransfer;
use Generated\Shared\Transfer\SynchronizationDataTransfer;
use Spryker\Client\Storage\StorageClientInterface;
use Spryker\Client\Store\StoreClientInterface;
use Spryker\Service\Synchronization\Dependency\Plugin\SynchronizationKeyGeneratorPluginInterface;
use Spryker\Service\Synchronization\SynchronizationServiceInterface;
use ValanticSpryker\Client\SitemapStorage\Mapper\SitemapStorageMapperInterface;
use ValanticSpryker\Shared\SitemapStorage\SitemapStorageConstants;

class SitemapMatcher implements SitemapMatcherInterface
{
    private static ?SynchronizationKeyGeneratorPluginInterface $storageKeyBuilder = null;

    /**
     * @var \Spryker\Client\Storage\StorageClientInterface
     */
    private StorageClientInterface $storageClient;

    /**
     * @var \Spryker\Client\Store\StoreClientInterface
     */
    private StoreClientInterface $storeClient;

    /**
     * @var \Spryker\Service\Synchronization\SynchronizationServiceInterface
     */
    private SynchronizationServiceInterface $synchronizationService;

    /**
     * @var \ValanticSpryker\Client\SitemapStorage\Mapper\SitemapStorageMapperInterface
     */
    private SitemapStorageMapperInterface $sitemapStorageMapper;

    /**
     * @param \Spryker\Client\Storage\StorageClientInterface $storageClient
     * @param \Spryker\Client\Store\StoreClientInterface $storeClient
     * @param \Spryker\Service\Synchronization\SynchronizationServiceInterface $synchronizationService
     * @param \ValanticSpryker\Client\SitemapStorage\Mapper\SitemapStorageMapperInterface $sitemapStorageMapper
     */
    public function __construct(
        StorageClientInterface $storageClient,
        StoreClientInterface $storeClient,
        SynchronizationServiceInterface $synchronizationService,
        SitemapStorageMapperInterface $sitemapStorageMapper
    ) {
        $this->storageClient = $storageClient;
        $this->storeClient = $storeClient;
        $this->synchronizationService = $synchronizationService;
        $this->sitemapStorageMapper = $sitemapStorageMapper;
    }

    /**
     * @param \Generated\Shared\Transfer\SitemapRequestTransfer $sitemapRequestTransfer
     *
     * @return \Generated\Shared\Transfer\SitemapResponseTransfer
     */
    public function matchSitemap(SitemapRequestTransfer $sitemapRequestTransfer): SitemapResponseTransfer
    {
        $sitemapName = $sitemapRequestTransfer->getFilename();
        $currenStore = $this->storeClient->getCurrentStore()->getName();
        $key = $this->generateKey($sitemapName, $currenStore);
        $data = $this->storageClient->get($key);

        $responseTransfer = (new SitemapResponseTransfer())->setIsSuccessful(true);

        if (!$data) {
            return $responseTransfer->setIsSuccessful(false);
        }

        $sitemapFile = $this->sitemapStorageMapper
            ->mapStorageDataToSitemapFileTransfer($data, $sitemapName, $currenStore);
        $responseTransfer->setSitemapFile($sitemapFile);

        return $responseTransfer;
    }

    /**
     * @return \Spryker\Service\Synchronization\Dependency\Plugin\SynchronizationKeyGeneratorPluginInterface
     */
    protected function getStorageKeyBuilder(): SynchronizationKeyGeneratorPluginInterface
    {
        self::$storageKeyBuilder ??= $this->synchronizationService
            ->getStorageKeyBuilder(SitemapStorageConstants::SITEMAP_STORAGE_RESOURCE_NAME);

        return self::$storageKeyBuilder;
    }

    /**
     * @param string $sitemapName
     * @param string $currenStore
     *
     * @return string
     */
    private function generateKey(string $sitemapName, string $currenStore): string
    {
        $dataTransfer = new SynchronizationDataTransfer();
        $dataTransfer->setStore($currenStore);
        $dataTransfer->setReference($sitemapName);

        return $this->getStorageKeyBuilder()->generateKey($dataTransfer);
    }
}
