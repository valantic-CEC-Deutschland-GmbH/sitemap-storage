<?php

declare(strict_types = 1);

namespace ValanticSpryker\Client\SitemapStorage\Plugin\Resolver;

use Generated\Shared\Transfer\SitemapRequestTransfer;
use Generated\Shared\Transfer\SitemapResponseTransfer;
use Spryker\Client\Kernel\AbstractPlugin;
use ValanticSpryker\Shared\Sitemap\Dependency\Plugin\SitemapResolverPluginInterface;

/**
 * @method \ValanticSpryker\Client\Sitemap\SitemapClientInterface getClient()
 */
class SitemapRedisResolverPlugin extends AbstractPlugin implements SitemapResolverPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\SitemapRequestTransfer $sitemapTransfer
     *
     * @return \Generated\Shared\Transfer\SitemapResponseTransfer
     */
    public function getSitemap(SitemapRequestTransfer $sitemapTransfer): SitemapResponseTransfer
    {
        return $this->getClient()
            ->getSitemap($sitemapTransfer);
    }
}
