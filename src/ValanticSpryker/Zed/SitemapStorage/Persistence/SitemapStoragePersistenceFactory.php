<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\SitemapStorage\Persistence;

use Orm\Zed\Sitemap\Persistence\PyzSitemapQuery;
use Orm\Zed\SitemapStorage\Persistence\PyzSitemapStorageQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \ValanticSpryker\Zed\SitemapStorage\SitemapStorageConfig getConfig()
 */
class SitemapStoragePersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\SitemapStorage\Persistence\PyzSitemapStorageQuery
     */
    public function createPyzSitemapStorageQuery(): PyzSitemapStorageQuery
    {
        return PyzSitemapStorageQuery::create();
    }

    /**
     * @return \Orm\Zed\Sitemap\Persistence\PyzSitemapQuery
     */
    public function createPyzSitemapQuery(): PyzSitemapQuery
    {
        return PyzSitemapQuery::create();
    }
}
