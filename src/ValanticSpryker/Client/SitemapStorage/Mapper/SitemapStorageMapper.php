<?php

declare(strict_types = 1);

namespace ValanticSpryker\Client\SitemapStorage\Mapper;

use Generated\Shared\Transfer\SitemapFileTransfer;
use ValanticSpryker\Shared\SitemapStorage\SitemapStorageConstants;

class SitemapStorageMapper implements SitemapStorageMapperInterface
{
    /**
     * @param array<string> $storageData
     * @param string $sitemapName
     *
     * @return \Generated\Shared\Transfer\SitemapFileTransfer
     */
    public function mapStorageDataToSitemapFileTransfer(array $storageData, string $sitemapName): SitemapFileTransfer
    {
        $data = $storageData[SitemapStorageConstants::SITEMAP_REDIS_CONTENT_KEY];

        $sitemapFileTransfer = new SitemapFileTransfer();
        $sitemapFileTransfer->setContent($data);
        $sitemapFileTransfer->setName($sitemapName);

        return $sitemapFileTransfer;
    }
}
