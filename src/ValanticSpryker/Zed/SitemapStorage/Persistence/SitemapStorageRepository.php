<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\SitemapStorage\Persistence;

use Orm\Zed\SitemapStorage\Persistence\Map\ValSitemapStorageTableMap;
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
            ->createValSitemapQuery()
            ->filterByIdSitemap_In($sitemapIds)
            ->find()
            ->getData();
    }

    /**
     * @inheritDoc
     */
    public function findSitemapStorageBySitemapIds(array $entitiesIds): array
    {
        return $this->getFactory() /** @phpstan-ignore-line */
            ->createValSitemapStorageQuery()
            ->filterByFkValSitemap_In($entitiesIds)
            ->find()
            ->toKeyIndex(ValSitemapStorageTableMap::getTableMap()->getColumn(ValSitemapStorageTableMap::COL_FK_VAL_SITEMAP)->getPhpName());
    }
}
