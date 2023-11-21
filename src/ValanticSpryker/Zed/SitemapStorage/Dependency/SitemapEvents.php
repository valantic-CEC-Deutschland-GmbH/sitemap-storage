<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\SitemapStorage\Dependency;

interface SitemapEvents
{
    public const ENTITY_PYZ_SITEMAP_CREATE = 'Entity.pyz_sitemap.create';
    public const ENTITY_PYZ_SITEMAP_UPDATE = 'Entity.pyz_sitemap.update';
    public const ENTITY_PYZ_SITEMAP_DELETE = 'Entity.pyz_sitemap.delete';
}
