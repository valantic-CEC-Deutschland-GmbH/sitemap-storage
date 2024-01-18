<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\SitemapStorage\Persistence;

use Orm\Zed\Sitemap\Persistence\ValSitemapQuery;
use Orm\Zed\SitemapStorage\Persistence\ValSitemapStorageQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \ValanticSpryker\Zed\SitemapStorage\SitemapStorageConfig getConfig()
 */
class SitemapStoragePersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\SitemapStorage\Persistence\ValSitemapStorageQuery
     */
    public function createValSitemapStorageQuery(): ValSitemapStorageQuery
    {
        return ValSitemapStorageQuery::create();
    }

    /**
     * @return \Orm\Zed\Sitemap\Persistence\ValSitemapQuery
     */
    public function createValSitemapQuery(): ValSitemapQuery
    {
        return ValSitemapQuery::create();
    }
}
