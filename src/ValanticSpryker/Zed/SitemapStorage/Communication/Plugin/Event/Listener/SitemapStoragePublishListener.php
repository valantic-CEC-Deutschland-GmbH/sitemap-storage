<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\SitemapStorage\Communication\Plugin\Event\Listener;

use Spryker\Zed\Event\Dependency\Plugin\EventBulkHandlerInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \ValanticSpryker\Zed\SitemapStorage\Communication\SitemapStorageCommunicationFactory getFactory()
 * @method \ValanticSpryker\Zed\SitemapStorage\Business\SitemapStorageFacadeInterface getFacade()
 */
class SitemapStoragePublishListener extends AbstractPlugin implements EventBulkHandlerInterface
{
    /**
     * @param array<\Generated\Shared\Transfer\EventEntityTransfer> $eventEntityTransfers
     * @param string $eventName
     *
     * @return void
     */
    public function handleBulk(array $eventEntityTransfers, $eventName): void
    {
        $sitemapIds = $this->getFactory()
            ->getEventBehaviorFacade()
            ->getEventTransferIds($eventEntityTransfers);

        $this->getFacade()->publishSitemap($sitemapIds);
    }
}
