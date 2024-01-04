<?php

declare(strict_types = 1);

namespace ValanticSpryker\Client\SitemapStorage;

use Generated\Shared\Transfer\SitemapRequestTransfer;
use Generated\Shared\Transfer\SitemapResponseTransfer;

interface SitemapStorageClientInterface
{
    /**
     * Retrieves sitemap from storage
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\SitemapRequestTransfer $sitemapTransfer
     *
     * @return \Generated\Shared\Transfer\SitemapResponseTransfer
     */
    public function getSitemap(SitemapRequestTransfer $sitemapTransfer): SitemapResponseTransfer;
}
