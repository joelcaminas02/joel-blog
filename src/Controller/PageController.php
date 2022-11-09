<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    /**
    * @Route("/", name="index")
    */
    public function index(): Response
    {
        return $this->render('page/index.html.twig', []);
    }

    /**
     * @Route("/about", name="about")
     */
    public function about(): Response
    {
        return $this->render('page/about.html.twig', []);
    }
    /**
     * @Route("/contact", name="contact")
     */
    public function contact(): Response
    {
        return $this->render('page/contact.html.twig', []);
    }
    /**
     * @Route("/class", name="class")
     */
    public function class(): Response
    {
        return $this->render('page/class.html.twig', []);
    }
    /**
     * @Route("/feature", name="feature")
     */
    public function feature(): Response
    {
        return $this->render('page/feature.html.twig', []);
    }
}
