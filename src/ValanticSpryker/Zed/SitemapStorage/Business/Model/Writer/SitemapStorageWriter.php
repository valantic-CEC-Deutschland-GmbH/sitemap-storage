<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\SitemapStorage\Business\Model\Writer;

use Orm\Zed\Sitemap\Persistence\Base\PyzSitemap;
use Orm\Zed\SitemapStorage\Persistence\PyzSitemapStorage;
use Spryker\Zed\Store\Business\StoreFacadeInterface;
use ValanticSpryker\Shared\SitemapStorage\SitemapStorageConstants;
use ValanticSpryker\Zed\SitemapStorage\Persistence\SitemapStorageRepositoryInterface;

class SitemapStorageWriter implements SitemapStorageWriterInterface
{
    /**
     * @var \ValanticSpryker\Zed\SitemapStorage\Persistence\SitemapStorageRepositoryInterface
     */
    private SitemapStorageRepositoryInterface $repository;

    /**
     * @var \Spryker\Zed\Store\Business\StoreFacadeInterface
     */
    private StoreFacadeInterface $storeFacade;

    /**
     * @param \ValanticSpryker\Zed\SitemapStorage\Persistence\SitemapStorageRepositoryInterface $repository
     * @param \Spryker\Zed\Store\Business\StoreFacadeInterface $storeFacade
     */
    public function __construct(
        SitemapStorageRepositoryInterface $repository,
        StoreFacadeInterface $storeFacade
    ) {
        $this->repository = $repository;
        $this->storeFacade = $storeFacade;
    }

    /**
     * @inheritDoc
     */
    public function publish(array $sitemapIds): void
    {
        $sitemapEntities = $this->repository->findSitemapByIds($sitemapIds);
        $entitiesIds = $this->retrieveExistingSitemapIds($sitemapEntities);
        $sitemapStorageEntities = $this->repository->findSitemapStorageBySitemapIds($entitiesIds);

        $this->storeData($sitemapEntities, $sitemapStorageEntities);
    }

    /**
     * @inheritDoc
     */
    public function unpublish(array $sitemapIds): void
    {
        $sitemapStorageEntities = $this->repository->findSitemapStorageBySitemapIds($sitemapIds);

        foreach ($sitemapStorageEntities as $sitemapStorageEntity) {
            $sitemapStorageEntity->delete();
        }
    }

    /**
     * @param array<\Orm\Zed\Sitemap\Persistence\PyzSitemap> $sitemapEntities
     *
     * @return array<int>
     */
    private function retrieveExistingSitemapIds(array $sitemapEntities): array
    {
        return array_map(static function (PyzSitemap $sitemap) {
            return $sitemap->getIdSitemap();
        }, $sitemapEntities);
    }

    /**
     * @param array<\Orm\Zed\Sitemap\Persistence\PyzSitemap> $sitemapEntities
     * @param array<\Orm\Zed\SitemapStorage\Persistence\PyzSitemapStorage> $sitemapStorageEntities
     *
     * @return void
     */
    private function storeData(array $sitemapEntities, array $sitemapStorageEntities): void
    {
        $storeName = $this->storeFacade->getCurrentStore()->getName();

        foreach ($sitemapEntities as $sitemapEntity) {
            $sitemapStorageEntity = $sitemapStorageEntities[$sitemapEntity->getIdSitemap()] ?? new PyzSitemapStorage();

            $this->storeDataSet($sitemapEntity, $sitemapStorageEntity, $storeName);
        }
    }

    /**
     * @param \Orm\Zed\Sitemap\Persistence\Base\PyzSitemap $sitemapEntity
     * @param \Orm\Zed\SitemapStorage\Persistence\PyzSitemapStorage $sitemapStorageEntity
     * @param string $storeName
     *
     * @return void
     */
    private function storeDataSet(PyzSitemap $sitemapEntity, PyzSitemapStorage $sitemapStorageEntity, string $storeName): void
    {
        $sitemapStorageEntity->setFkPyzSitemap($sitemapEntity->getIdSitemap());
        $sitemapStorageEntity->setName($sitemapEntity->getName());
        $sitemapStorageEntity->setStore($storeName);
        $sitemapStorageEntity->setData(
            [
                SitemapStorageConstants::SITEMAP_REDIS_CONTENT_KEY => $sitemapEntity->getContent(),
            ],
        );
        $sitemapStorageEntity->setIsSendingToQueue(true);

        if ($sitemapStorageEntity->isNew() || $sitemapStorageEntity->isModified()) {
            $sitemapStorageEntity->save();
        }
    }
}
