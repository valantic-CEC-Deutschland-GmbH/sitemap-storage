# Sitemap Storage

# Description

Adds functionality to publish and retrieve sitemap data from storage (Redis). The data is stored in DB and synced to Redis for faster retrieval.

> :warning: This package does not support Spryker setups that have different Redis instances for different stores


# Installation

1. `composer require valantic-spryker/sitemap-storage`
2. Since this module is under `ValanticSpryker` namespace, make sure that in `config_default`:
    1. `$config[KernelConstants::CORE_NAMESPACES]` has the namespace
    2. `$config[KernelConstants::PROJECT_NAMESPACES]` has the namespace
3. Run `console propel:install` to install the `val_sitemap_storage` table.

## 4. Add relevant queues to `QueueDependencyProvider`:

```php
     protected function getProcessorMessagePlugins(Container $container): array
    {
        return [
            // ...
            SitemapStorageConfig::PUBLISH_SITEMAP => new EventQueueMessageProcessorPlugin(),
            SitemapStorageConfig::SITEMAP_SYNC_STORAGE_QUEUE => new SynchronizationStorageQueueMessageProcessorPlugin(),
        ];
    }
```

## 5. Register `SitemapStorageEventSubscriber`
Add
```php
ValanticSpryker\Zed\SitemapStorage\Communication\Plugin\Event\Subscriber\SitemapStorageEventSubscriber
```
in
```php
\Pyz\Zed\Event\EventDependencyProvider::getEventSubscriberCollection
```
to handle all publish and unpublish events:

```php
public function getEventSubscriberCollection(): EventSubscriberCollectionInterface
{
    $eventSubscriberCollection = parent::getEventSubscriberCollection();
    // ...
    $eventSubscriberCollection->add(new SitemapStorageEventSubscriber());
}
```
## 6. Enable `SitemapStorageClient`

Since `SitemapStorageClient` implements the same interface as `SitemapClient`, both clients can be used interchangeably.

So to make the main Sitemap module retrieve data from Redis, the `SitemapStorageClient` needs to be switched with regular `SitemapClient` in:

```php
\ValanticSpryker\Yves\Sitemap\SitemapDependencyProvider
```

```php
protected function addSitemapClient(Container $container): void
{
    $container->set(static::CLIENT_SITEMAP, static function (Container $container): SitemapClientInterface {
        return $container->getLocator()->sitemapStorage()->client();
    });
}
```
Now the `SitemapStorageClient` is used instead, and it takes care of retrieving the data from Redis and mapping to correct transfer.

## 7. Add queue configuration to `\Pyz\Client\RabbitMq\RabbitMqConfig`

```php
    protected function getPyzPublishQueueConfiguration(): array
    {
        return [
            // [...]
            SitemapStorageConfig::PUBLISH_SITEMAP,
        ];
    }

    protected function getPyzSynchronizationQueueConfiguration(): array
    {
        return [
            // [...]
            SitemapStorageConfig::SITEMAP_SYNC_STORAGE_QUEUE,
        ];
    }
```
