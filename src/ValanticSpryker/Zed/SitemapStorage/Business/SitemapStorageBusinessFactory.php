<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\SitemapStorage\Business;

use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use ValanticSpryker\Zed\SitemapStorage\Business\Model\Writer\SitemapStorageWriter;
use ValanticSpryker\Zed\SitemapStorage\Business\Model\Writer\SitemapStorageWriterInterface;

/**
 * @method \ValanticSpryker\Zed\SitemapStorage\SitemapStorageConfig getConfig()
 * @method \ValanticSpryker\Zed\SitemapStorage\Persistence\SitemapStorageRepositoryInterface getRepository()
 */
class SitemapStorageBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \ValanticSpryker\Zed\SitemapStorage\Business\Model\Writer\SitemapStorageWriterInterface
     */
    public function createSitemapStorageWriter(): SitemapStorageWriterInterface
    {
        return new SitemapStorageWriter($this->getRepository());
    }
}
