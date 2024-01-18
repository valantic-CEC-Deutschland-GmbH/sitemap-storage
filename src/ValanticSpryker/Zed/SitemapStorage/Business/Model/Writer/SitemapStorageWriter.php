<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\SitemapStorage\Business\Model\Writer;

use Orm\Zed\Sitemap\Persistence\Base\ValSitemap;
use Orm\Zed\SitemapStorage\Persistence\ValSitemapStorage;
use ValanticSpryker\Shared\SitemapStorage\SitemapStorageConstants;
use ValanticSpryker\Zed\SitemapStorage\Persistence\SitemapStorageRepositoryInterface;

class SitemapStorageWriter implements SitemapStorageWriterInterface
{
    /**
     * @var \ValanticSpryker\Zed\SitemapStorage\Persistence\SitemapStorageRepositoryInterface
     */
    private SitemapStorageRepositoryInterface $repository;

    /**
     * @param \ValanticSpryker\Zed\SitemapStorage\Persistence\SitemapStorageRepositoryInterface $repository
     */
    public function __construct(SitemapStorageRepositoryInterface $repository)
    {
        $this->repository = $repository;
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
     * @param array<\Orm\Zed\Sitemap\Persistence\ValSitemap> $sitemapEntities
     *
     * @return array<int>
     */
    protected function retrieveExistingSitemapIds(array $sitemapEntities): array
    {
        return array_map(static function (ValSitemap $sitemap) {
            return $sitemap->getIdSitemap();
        }, $sitemapEntities);
    }

    /**
     * @param array<\Orm\Zed\Sitemap\Persistence\ValSitemap> $sitemapEntities
     * @param array<\Orm\Zed\SitemapStorage\Persistence\ValSitemapStorage> $sitemapStorageEntities
     *
     * @return void
     */
    protected function storeData(array $sitemapEntities, array $sitemapStorageEntities): void
    {
        foreach ($sitemapEntities as $sitemapEntity) {
            $sitemapStorageEntity = $sitemapStorageEntities[$sitemapEntity->getIdSitemap()] ?? new ValSitemapStorage();

            $this->storeDataSet($sitemapEntity, $sitemapStorageEntity);
        }
    }

    /**
     * @param \Orm\Zed\Sitemap\Persistence\Base\ValSitemap $sitemapEntity
     * @param \Orm\Zed\SitemapStorage\Persistence\ValSitemapStorage $sitemapStorageEntity
     *
     * @return void
     */
    protected function storeDataSet(ValSitemap $sitemapEntity, ValSitemapStorage $sitemapStorageEntity): void
    {
        $sitemapStorageEntity->setFkValSitemap($sitemapEntity->getIdSitemap());
        $sitemapStorageEntity->setName($sitemapEntity->getName());
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
