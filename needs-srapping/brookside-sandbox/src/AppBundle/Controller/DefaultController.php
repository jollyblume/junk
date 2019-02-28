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

    /**
     * @Route("/pad", name="scratchpad", options={"sitemap" = true})
     */
    public function scratchpadAction()
    {
        return $this->render('@App/Default/scratchpad.html.twig');
    }

    /**
     * @Route("/hero", name="sectionhero", options={"sitemap" = true})
     */
    public function scratchpadHeroAction()
    {
        return $this->render('@App/Default/hero.html.twig');
    }

    /**
     * @Route("/about", name="sectionabout", options={"sitemap" = true})
     */
    public function scratchpadAboutAction()
    {
        return $this->render('@App/Default/about.html.twig');
    }

    /**
     * @Route("/find", name="sectionfind", options={"sitemap" = true})
     */
    public function scratchpadFindAction()
    {
        return $this->render('@App/Default/find.html.twig');
    }


    /**
     * @Route("/use", name="sectionuse", options={"sitemap" = true})
     */
    public function scratchpadUseAction()
    {
        return $this->render('@App/Default/use.html.twig');
    }

    /**
     * @Route("/why", name="sectionwhy", options={"sitemap" = true})
     */
    public function scratchpadWhyAction()
    {
        return $this->render('@App/Default/why.html.twig');
    }


    /**
    * @Route("/trust", name="sectiontrust", options={"sitemap" = true})
    */
    public function scratchpadTrustAction()
    {
        return $this->render('@App/Default/trust.html.twig');
    }

    /**
     * @Route("/contact", name="sectioncontact", options={"sitemap" = true})
     */
    public function scratchpadContactAction()
    {
        return $this->render('@App/Default/contact.html.twig');
    }
}
