<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/test")
 */
class TestController extends AbstractController
{
    /**
     * @Route("/", name="landingpage")
     */
    public function landingpage()
    {
        return $this->render('test/landingpage.html.twig');
    }

    /**
     * @Route("/main", name="main")
     */
    public function mainpage()
    {
        return $this->render('test/mainpage.html.twig');
    }

    /**
     * @Route("/spa", name="spa")
     */
    public function spapage()
    {
        return $this->render('test/spa.html.twig');
    }

    /**
     * @Route("/wtf", name="wtf")
     */
    public function wtfpage()
    {
        return $this->render('test/wtf.html.twig');
    }
}
