<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\SitemapStorage\Business;

use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \ValanticSpryker\Zed\SitemapStorage\Business\SitemapStorageBusinessFactory getFactory()
 */
class SitemapStorageFacade extends AbstractFacade implements SitemapStorageFacadeInterface
{
    /**
     * @inheritDoc
     */
    public function publishSitemap(array $sitemapIds): void
    {
        $this->getFactory()->createSitemapStorageWriter()->publish($sitemapIds);
    }

    /**
     * @inheritDoc
     */
    public function unpublishSitemap(array $sitemapIds): void
    {
        $this->getFactory()->createSitemapStorageWriter()->unpublish($sitemapIds);
    }
}
