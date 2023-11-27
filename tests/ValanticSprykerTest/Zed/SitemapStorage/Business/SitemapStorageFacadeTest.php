<?php

declare(strict_types = 1);

namespace ValanticSprykerTest\Zed\SitemapStorage\Business;

use Codeception\Test\Unit;
use Orm\Zed\Sitemap\Persistence\PyzSitemap;
use Orm\Zed\SitemapStorage\Persistence\PyzSitemapStorageQuery;
use Propel\Runtime\Propel;
use ValanticSprykerTest\Zed\SitemapStorage\SitemapStorageBusinessTester;

/**
 * Auto-generated group annotations
 *
 * @group ValanticSprykerTest
 * @group Zed
 * @group SitemapStorage
 * @group Business
 * @group SitemapStorageFacadeTest
 * Add your own group annotations below this line
 */
class SitemapStorageFacadeTest extends Unit
{
    public SitemapStorageBusinessTester $tester;

    /**
     * @return void
     */
    public function testPublish(): void
    {
        // ARRANGE
        $storeFacade = $this->tester->getLocator()->store()->facade();
        $currentStoreName = $storeFacade->getCurrentStore()->getName();
        $sitemapStorageFacade = $this->tester->getLocator()->sitemapStorage()->facade();

        $sitemap = new PyzSitemap();
        $sitemap->setName('test-name');
        $sitemap->setContent('test-xml');
        $sitemap->setStoreName($currentStoreName);
        $sitemap->setYvesBaseUrl('test-base-url');
        $sitemap->save();
        $idSitemap = $sitemap->getIdSitemap();

        // ACT
        $sitemapStorageFacade->publishSitemap([$idSitemap]);

        // ASSERT
        self::assertNotNull(PyzSitemapStorageQuery::create()->findOneByFkPyzSitemap($idSitemap));
    }

    /**
     * @return void
     */
    public function testPublishUpdate(): void
    {
        Propel::disableInstancePooling();
        // ARRANGE
        $storeFacade = $this->tester->getLocator()->store()->facade();
        $currentStoreName = $storeFacade->getCurrentStore()->getName();
        $sitemapStorageFacade = $this->tester->getLocator()->sitemapStorage()->facade();

        $sitemap = new PyzSitemap();
        $sitemap->setName('test-name');
        $sitemap->setContent('test-xml');
        $sitemap->setStoreName($currentStoreName);
        $sitemap->setYvesBaseUrl('test-base-url');
        $sitemap->save();
        $idSitemap = $sitemap->getIdSitemap();

        // ACT
        $sitemapStorageFacade->publishSitemap([$idSitemap]);
        $sitemap->setName('test-name-updated');
        $sitemap->save();
        $sitemapStorageFacade->publishSitemap([$idSitemap]);

        // ASSERT
        $pyzSitemapStorage = PyzSitemapStorageQuery::create()->findOneByFkPyzSitemap($idSitemap);
        self::assertNotNull($pyzSitemapStorage);
        self::assertSame('test-name-updated', $pyzSitemapStorage->getName());
        Propel::enableInstancePooling();
    }

    /**
     * @return void
     */
    public function testUnpublish(): void
    {
        // ARRANGE
        $storeFacade = $this->tester->getLocator()->store()->facade();
        $currentStoreName = $storeFacade->getCurrentStore()->getName();
        $sitemapStorageFacade = $this->tester->getLocator()->sitemapStorage()->facade();

        $sitemap = new PyzSitemap();
        $sitemap->setName('test-name');
        $sitemap->setContent('test-xml');
        $sitemap->setStoreName($currentStoreName);
        $sitemap->setYvesBaseUrl('test-base-url');
        $sitemap->save();
        $idSitemap = $sitemap->getIdSitemap();

        // ACT
        $sitemapStorageFacade->unpublishSitemap([$idSitemap]);

        // ASSERT
        self::assertNull(PyzSitemapStorageQuery::create()->findOneByFkPyzSitemap($idSitemap));
    }
}
