<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ReactController extends Controller
{
    /**
     * @Route("/basic-scroll", name="basic-scroll")
     */
    public function basicScroll()
    {
        return $this->render('react/basic-scroll.html.twig', [
            'controller_name' => 'ReactController',
        ]);
    }
}
