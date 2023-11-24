<?php

declare(strict_types = 1);

namespace ValanticSpryker\Client\SitemapStorage;

use Generated\Shared\Transfer\SitemapRequestTransfer;
use Generated\Shared\Transfer\SitemapResponseTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \ValanticSpryker\Client\SitemapStorage\SitemapStorageFactory getFactory()
 */
class SitemapStorageClient extends AbstractClient implements SitemapStorageClientInterface
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
