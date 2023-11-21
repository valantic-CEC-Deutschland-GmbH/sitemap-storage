<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\SitemapStorage\Business;

interface SitemapStorageFacadeInterface
{
    /**
     * @param array<int> $sitemapIds
     *
     * @return void
     */
    public function publishSitemap(array $sitemapIds): void;

    /**
     * @param array<int> $sitemapIds
     *
     * @return void
     */
    public function unpublishSitemap(array $sitemapIds): void;
}
