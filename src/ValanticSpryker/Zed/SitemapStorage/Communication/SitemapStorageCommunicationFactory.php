<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\SitemapStorage\Communication;

use Spryker\Zed\EventBehavior\Business\EventBehaviorFacadeInterface;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;
use ValanticSpryker\Zed\SitemapStorage\SitemapStorageDependencyProvider;

/**
 * @method \ValanticSpryker\Zed\SitemapStorage\SitemapStorageConfig getConfig()
 */
class SitemapStorageCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * @return \Spryker\Zed\EventBehavior\Business\EventBehaviorFacadeInterface
     */
    public function getEventBehaviorFacade(): EventBehaviorFacadeInterface
    {
        return $this->getProvidedDependency(SitemapStorageDependencyProvider::FACADE_EVENT_BEHAVIOR);
    }
}
