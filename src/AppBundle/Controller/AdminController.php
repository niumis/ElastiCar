<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AdminController extends Controller
{
    /**
     * @Route("/admin", name="admin_index")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Admin/Pages:index.html.twig', array(// ...
        ));
    }

    /**
     * @Route("/admin/filters", name="admin_filters")
     */
    public function filtersAction()
    {
        return $this->render('AppBundle:Admin/Pages:filters.html.twig', array(// ...
        ));
    }

    /**
     * @Route("/admin/stats/visitors", name="admin_stats_visitors")
     */
    public function visitorStatsAction()
    {
        return $this->render('AppBundle:Admin/Pages:visitors_stats.html.twig', array(// ...
        ));
    }

    /**
     * @Route("/admin/stats/crawler", name="admin_stats_crawler")
     */
    public function crawlerStatsAction()
    {
        return $this->render('AppBundle:Admin/Pages:crawler_stats.html.twig', array(// ...
        ));
    }

    /**
     * @Route("/admin/settings", name="admin_settings")
     */
    public function settingsAction()
    {
        return $this->render('AppBundle:Admin/Pages:settings.html.twig', array(// ...
        ));
    }

}
