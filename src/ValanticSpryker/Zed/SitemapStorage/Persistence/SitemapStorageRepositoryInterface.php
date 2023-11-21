<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\SitemapStorage\Persistence;

interface SitemapStorageRepositoryInterface
{
    /**
     * @param array<int> $sitemapIds
     *
     * @return array<\Orm\Zed\Sitemap\Persistence\PyzSitemap>
     */
    public function findSitemapByIds(array $sitemapIds): array;

    /**
     * @param array<int> $entitiesIds
     *
     * @return array<\Orm\Zed\SitemapStorage\Persistence\PyzSitemapStorage>
     */
    public function findSitemapStorageBySitemapIds(array $entitiesIds): array;
}
