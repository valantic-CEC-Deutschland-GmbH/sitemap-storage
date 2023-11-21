<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\SitemapStorage;

use Spryker\Shared\Publisher\PublisherConfig;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class SitemapStorageConfig extends AbstractBundleConfig
{
    public const PUBLISH_SITEMAP = 'publish.sitemap';
    public const SITEMAP_SYNC_STORAGE_QUEUE = 'sync.storage.sitemap';

    /**
     * @return string
     */
    public function getSitemapEventQueueName(): string
    {
        return PublisherConfig::PUBLISH_QUEUE;
    }
}
