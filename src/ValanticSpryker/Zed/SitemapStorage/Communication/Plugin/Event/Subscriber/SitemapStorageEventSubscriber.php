<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\SitemapStorage\Communication\Plugin\Event\Subscriber;

use Spryker\Zed\Event\Dependency\EventCollectionInterface;
use Spryker\Zed\Event\Dependency\Plugin\EventSubscriberInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use ValanticSpryker\Zed\SitemapStorage\Communication\Plugin\Event\Listener\SitemapStoragePublishListener;
use ValanticSpryker\Zed\SitemapStorage\Communication\Plugin\Event\Listener\SitemapStorageUnpublishListener;
use ValanticSpryker\Zed\SitemapStorage\Dependency\SitemapEvents;

/**
 * @method \ValanticSpryker\Zed\SitemapStorage\SitemapStorageConfig getConfig()
 */
class SitemapStorageEventSubscriber extends AbstractPlugin implements EventSubscriberInterface
{
    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return \Spryker\Zed\Event\Dependency\EventCollectionInterface
     */
    public function getSubscribedEvents(EventCollectionInterface $eventCollection): EventCollectionInterface
    {
        $this->addSitemapCreateStorageListener($eventCollection);
        $this->addSitemapUpdateListener($eventCollection);
        $this->addSitemapUnpublishListener($eventCollection);

        return $eventCollection;
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return void
     */
    private function addSitemapCreateStorageListener(EventCollectionInterface $eventCollection): void
    {
        $eventCollection->addListenerQueued(
            SitemapEvents::ENTITY_PYZ_SITEMAP_CREATE,
            new SitemapStoragePublishListener(),
            0,
            null,
            $this->getConfig()->getSitemapEventQueueName(),
        );
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return void
     */
    private function addSitemapUpdateListener(EventCollectionInterface $eventCollection): void
    {
        $eventCollection->addListenerQueued(
            SitemapEvents::ENTITY_PYZ_SITEMAP_UPDATE,
            new SitemapStoragePublishListener(),
            0,
            null,
            $this->getConfig()->getSitemapEventQueueName(),
        );
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return void
     */
    private function addSitemapUnpublishListener(EventCollectionInterface $eventCollection): void
    {
        $eventCollection->addListenerQueued(
            SitemapEvents::ENTITY_PYZ_SITEMAP_DELETE,
            new SitemapStorageUnpublishListener(),
            0,
            null,
            $this->getConfig()->getSitemapEventQueueName(),
        );
    }
}
