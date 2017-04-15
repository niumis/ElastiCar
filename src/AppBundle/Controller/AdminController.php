<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AdminController extends Controller
{
    /**
     * @Route("/admin")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Admin/Pages:index.html.twig', array(// ...
        ));
    }

    /**
     * @Route("/admin/filters")
     */
    public function filtersAction()
    {
        return $this->render('AppBundle:Admin/Pages:filters.html.twig', array(// ...
        ));
    }

    /**
     * @Route("/admin/stats/visitors")
     */
    public function visitorStatsAction()
    {
        return $this->render('AppBundle:Admin/Pages:visitors_stats.html.twig', array(// ...
        ));
    }

    /**
     * @Route("/admin/stats/crawler")
     */
    public function crawlerStatsAction()
    {
        return $this->render('AppBundle:Admin/Pages:crawler_stats.html.twig', array(// ...
        ));
    }

    /**
     * @Route("/admin/settings")
     */
    public function settingsAction()
    {
        return $this->render('AppBundle:Admin/Pages:settings.html.twig', array(// ...
        ));
    }

}
