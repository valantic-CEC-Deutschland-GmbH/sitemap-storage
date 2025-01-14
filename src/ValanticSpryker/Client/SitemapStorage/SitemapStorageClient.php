<?php

declare(strict_types = 1);

namespace ValanticSpryker\Client\SitemapStorage;

use Generated\Shared\Transfer\SitemapRequestTransfer;
use Generated\Shared\Transfer\SitemapResponseTransfer;
use Spryker\Client\Kernel\AbstractClient;
use ValanticSpryker\Client\Sitemap\SitemapClientInterface;

/**
 * @method \ValanticSpryker\Client\SitemapStorage\SitemapStorageFactory getFactory()
 * @SuppressWarnings(PHPMD) // phpcs:ignore
 */
class SitemapStorageClient extends AbstractClient implements SitemapClientInterface
{
    /**
     * @param \Generated\Shared\Transfer\SitemapRequestTransfer $sitemapTransfer
     *
     * @return \Generated\Shared\Transfer\SitemapResponseTransfer
     */
    public function getSitemap(SitemapRequestTransfer $sitemapTransfer): SitemapResponseTransfer
    {
        return $this->getFactory()
            ->createSitemapMatcher()
            ->matchSitemap($sitemapTransfer);
    }
}
