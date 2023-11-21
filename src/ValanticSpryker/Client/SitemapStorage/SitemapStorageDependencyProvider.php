<?php

declare(strict_types = 1);

namespace ValanticSpryker\Client\SitemapStorage;

use Spryker\Client\Kernel\AbstractDependencyProvider;
use Spryker\Client\Kernel\Container;
use Spryker\Client\Storage\StorageClientInterface;
use Spryker\Client\Store\StoreClientInterface;
use Spryker\Service\Synchronization\SynchronizationServiceInterface;

class SitemapStorageDependencyProvider extends AbstractDependencyProvider
{
    public const CLIENT_STORAGE = 'CLIENT_STORAGE';
    public const CLIENT_STORE = 'CLIENT_STORE';
    public const SERVICE_SYNCHRONIZATION = 'SERVICE_SYNCHRONIZATION';

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    public function provideServiceLayerDependencies(Container $container): Container
    {
        $container = parent::provideServiceLayerDependencies($container);
        $this->addStorageClient($container);
        $this->addStoreClient($container);
        $this->addSynchronizationService($container);

        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return void
     */
    private function addStorageClient(Container $container): void
    {
        $container->set(self::CLIENT_STORAGE, function (Container $container): StorageClientInterface {
            return $container->getLocator()->storage()->client();
        });
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return void
     */
    private function addStoreClient(Container $container): void
    {
        $container->set(self::CLIENT_STORE, function (Container $container): StoreClientInterface {
            return $container->getLocator()->store()->client();
        });
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return void
     */
    private function addSynchronizationService(Container $container): void
    {
        $container->set(self::SERVICE_SYNCHRONIZATION, function (Container $container): SynchronizationServiceInterface {
            return $container->getLocator()->synchronization()->service();
        });
    }
}
