<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="_welcome", options={"sitemap" = true})
     */
    public function indexAction()
    {
        return $this->render('@App/Default/index.html.twig');
    }
}
