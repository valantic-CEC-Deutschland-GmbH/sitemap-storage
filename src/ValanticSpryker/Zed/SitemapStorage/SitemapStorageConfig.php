<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\SitemapStorage;

use Spryker\Zed\Kernel\AbstractBundleConfig;

class SitemapStorageConfig extends AbstractBundleConfig
{
    public const PUBLISH_SITEMAP = 'publish.sitemap';
    public const SITEMAP_SYNC_STORAGE_QUEUE = 'sync.storage.sitemap';
    public const PUBLISH_QUEUE = 'publish';

    /**
     * @return string
     */
    public function getSitemapEventQueueName(): string
    {
        return static::PUBLISH_QUEUE;
    }
}
