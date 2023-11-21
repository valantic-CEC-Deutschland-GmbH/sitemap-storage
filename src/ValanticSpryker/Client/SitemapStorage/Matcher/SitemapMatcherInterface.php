<?php

declare(strict_types = 1);

namespace ValanticSpryker\Client\SitemapStorage\Matcher;

use Generated\Shared\Transfer\SitemapRequestTransfer;
use Generated\Shared\Transfer\SitemapResponseTransfer;

interface SitemapMatcherInterface
{
    /**
     * @param \Generated\Shared\Transfer\SitemapRequestTransfer $sitemapRequestTransfer
     *
     * @return \Generated\Shared\Transfer\SitemapResponseTransfer
     */
    public function matchSitemap(SitemapRequestTransfer $sitemapRequestTransfer): SitemapResponseTransfer;
}
