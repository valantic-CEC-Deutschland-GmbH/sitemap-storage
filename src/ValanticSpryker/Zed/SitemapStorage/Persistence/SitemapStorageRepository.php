<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\SitemapStorage\Persistence;

use Orm\Zed\SitemapStorage\Persistence\Map\PyzSitemapStorageTableMap;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \ValanticSpryker\Zed\SitemapStorage\Persistence\SitemapStoragePersistenceFactory getFactory()
 */
class SitemapStorageRepository extends AbstractRepository implements SitemapStorageRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function findSitemapByIds(array $sitemapIds): array
    {
        return $this->getFactory()
            ->createPyzSitemapQuery()
            ->filterByIdSitemap_In($sitemapIds)
            ->find()
            ->getData();
    }

    /**
     * @inheritDoc
     */
    public function findSitemapStorageBySitemapIds(array $entitiesIds): array
    {
        return $this->getFactory()
            ->createPyzSitemapStorageQuery()
            ->filterByFkPyzSitemap_In($entitiesIds)
            ->find()
            ->toKeyIndex(PyzSitemapStorageTableMap::getTableMap()->getColumn(PyzSitemapStorageTableMap::COL_FK_PYZ_SITEMAP)->getPhpName());
    }
}
