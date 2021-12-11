<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class SitemapController extends AbstractController
{
    const SITEMAP_PATH = '../download/sitemap.xml';

    public function sitemapAction(): Response
    {
        return $this->file(self::SITEMAP_PATH);
    }
}
