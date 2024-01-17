<?php

declare(strict_types = 1);

namespace ValanticSprykerTest\Zed\SitemapStorage\Business;

use Codeception\Test\Unit;
use Orm\Zed\Sitemap\Persistence\ValSitemap;
use Orm\Zed\SitemapStorage\Persistence\ValSitemapStorageQuery;
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
        $sitemapStorageFacade = $this->tester->getLocator()->sitemapStorage()->facade();

        $sitemap = new ValSitemap();
        $sitemap->setName('test-name');
        $sitemap->setContent('test-xml');
        $sitemap->setYvesBaseUrl('test-base-url');
        $sitemap->save();
        $idSitemap = $sitemap->getIdSitemap();

        // ACT
        $sitemapStorageFacade->publishSitemap([$idSitemap]);

        // ASSERT
        self::assertNotNull(ValSitemapStorageQuery::create()->findOneByFkValSitemap($idSitemap));
    }

    /**
     * @return void
     */
    public function testPublishUpdate(): void
    {
        Propel::disableInstancePooling();
        // ARRANGE
        $sitemapStorageFacade = $this->tester->getLocator()->sitemapStorage()->facade();

        $sitemap = new ValSitemap();
        $sitemap->setName('test-name');
        $sitemap->setContent('test-xml');
        $sitemap->setYvesBaseUrl('test-base-url');
        $sitemap->save();
        $idSitemap = $sitemap->getIdSitemap();

        // ACT
        $sitemapStorageFacade->publishSitemap([$idSitemap]);
        $sitemap->setName('test-name-updated');
        $sitemap->save();
        $sitemapStorageFacade->publishSitemap([$idSitemap]);

        // ASSERT
        $valSitemapStorage = ValSitemapStorageQuery::create()->findOneByFkValSitemap($idSitemap);
        self::assertNotNull($valSitemapStorage);
        self::assertSame('test-name-updated', $valSitemapStorage->getName());
        Propel::enableInstancePooling();
    }

    /**
     * @return void
     */
    public function testUnpublish(): void
    {
        // ARRANGE
        $sitemapStorageFacade = $this->tester->getLocator()->sitemapStorage()->facade();

        $sitemap = new ValSitemap();
        $sitemap->setName('test-name');
        $sitemap->setContent('test-xml');
        $sitemap->setYvesBaseUrl('test-base-url');
        $sitemap->save();
        $idSitemap = $sitemap->getIdSitemap();

        // ACT
        $sitemapStorageFacade->unpublishSitemap([$idSitemap]);

        // ASSERT
        self::assertNull(ValSitemapStorageQuery::create()->findOneByFkValSitemap($idSitemap));
    }
}
