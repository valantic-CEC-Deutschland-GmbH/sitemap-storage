<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\SitemapStorage\Business\Model\Writer;

interface SitemapStorageWriterInterface
{
 /**
  * @param array<int> $sitemapIds
  *
  * @return void
  */
    public function publish(array $sitemapIds): void;

    /**
     * @param array<int> $sitemapIds
     *
     * @return void
     */
    public function unpublish(array $sitemapIds): void;
}
