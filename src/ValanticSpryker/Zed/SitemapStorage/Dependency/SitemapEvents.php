<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\SitemapStorage\Dependency;

interface SitemapEvents
{
    public const ENTITY_VAL_SITEMAP_CREATE = 'Entity.val_sitemap.create';
    public const ENTITY_VAL_SITEMAP_UPDATE = 'Entity.val_sitemap.update';
    public const ENTITY_VAL_SITEMAP_DELETE = 'Entity.val_sitemap.delete';
}
