<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\SitemapStorage;

use Spryker\Zed\EventBehavior\Business\EventBehaviorFacadeInterface;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Store\Business\StoreFacadeInterface;

/**
 * @method \ValanticSpryker\Zed\SitemapStorage\SitemapStorageConfig getConfig()
 */
class SitemapStorageDependencyProvider extends AbstractBundleDependencyProvider
{
    public const FACADE_EVENT_BEHAVIOR = 'FACADE_EVENT_BEHAVIOR';
    public const FACADE_STORE = 'FACADE_STORE';
    public const SERVICE_SYNCHRONIZATION = 'SERVICE_SYNCHRONIZATION';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);
        $this->addStoreFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideCommunicationLayerDependencies(Container $container): Container
    {
        $container = parent::provideCommunicationLayerDependencies($container);
        $this->addEventBehaviorFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return void
     */
    private function addEventBehaviorFacade(Container $container): void
    {
        $container->set(self::FACADE_EVENT_BEHAVIOR, function (Container $container): EventBehaviorFacadeInterface {
            return $container->getLocator()->eventBehavior()->facade();
        });
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return void
     */
    private function addStoreFacade(Container $container): void
    {
        $container->set(self::FACADE_STORE, function (Container $container): StoreFacadeInterface {
            return $container->getLocator()->store()->facade();
        });
    }
}
