# Sitemap Storage

# Description

Adds functionality to publish and retrieve sitemap data from storage (Redis). The data is stored in DB and synced to Redis for faster retrieval.


# Installation

1. `composer require valantic-spryker/sitemap-storage`
2. Since this module is under `ValanticSpryker` namespace, make sure that in `config_default`:
   1. `$config[KernelConstants::CORE_NAMESPACES]` has the namespace
   2. `$config[KernelConstants::PROJECT_NAMESPACES]` has the namespace
3. Run `console propel:install` to install the `pyz_sitemap_storage` table.
4. Add `ValanticSpryker\Zed\SitemapStorage\Communication\Plugin\Event\Subscriber\SitemapStorageEventSubscriber` to `\Pyz\Zed\Event\EventDependencyProvider::getEventSubscriberCollection` to handle all publish and unpublish events:

```php
public function getEventSubscriberCollection(): EventSubscriberCollectionInterface
{
    $eventSubscriberCollection = parent::getEventSubscriberCollection();
    // ...
    $eventSubscriberCollection->add(new SitemapStorageEventSubscriber());
}
```
5. Since `SitemapStorageClient` implements the same interface as `SitemapClient`, both clients can be used interchangeably. So to make the main Sitemap module retrieve data from Redis, the `SitemapStorageClient` needs to be switched with regular `SitemapClient` in `\ValanticSpryker\Yves\Sitemap\SitemapDependencyProvider`. Now the `SitemapStorageClient` is used instead, and it takes care of retrieving the data from Redis and mapping to correct transfer.

```php
protected function getSitemapClient(Container $container): SitemapClientInterface
{
    return $container->getLocator()->sitemapStorage()->client();
}
```
