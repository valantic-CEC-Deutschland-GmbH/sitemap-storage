<?php

declare(strict_types = 1);

namespace ValanticSpryker\Client\SitemapStorage\Mapper;

use Generated\Shared\Transfer\SitemapFileTransfer;

interface SitemapStorageMapperInterface
{
    /**
     * @param array<string> $storageData
     * @param string $sitemapName
     *
     * @return \Generated\Shared\Transfer\SitemapFileTransfer
     */
    public function mapStorageDataToSitemapFileTransfer(array $storageData, string $sitemapName): SitemapFileTransfer;
}
