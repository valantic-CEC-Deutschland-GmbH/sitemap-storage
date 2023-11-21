<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\SitemapStorage\Business;

use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use Spryker\Zed\Store\Business\StoreFacadeInterface;
use ValanticSpryker\Zed\SitemapStorage\Business\Model\Writer\SitemapStorageWriter;
use ValanticSpryker\Zed\SitemapStorage\Business\Model\Writer\SitemapStorageWriterInterface;
use ValanticSpryker\Zed\SitemapStorage\SitemapStorageDependencyProvider;

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
        return new SitemapStorageWriter(
            $this->getRepository(),
            $this->getStoreFacade(),
        );
    }

    /**
     * @return \Spryker\Zed\Store\Business\StoreFacadeInterface
     */
    public function getStoreFacade(): StoreFacadeInterface
    {
        return $this->getProvidedDependency(SitemapStorageDependencyProvider::FACADE_STORE);
    }
}
