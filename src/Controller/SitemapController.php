<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SitemapController extends AbstractController
{
    const SITEMAP_PATH = '../download/sitemap.xml';

    public function sitemapAction()
    {
        return $this->file(self::SITEMAP_PATH);
    }
}
