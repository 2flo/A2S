<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class recetteController extends AbstractController

{
    /**
     * @Route("/accueil", name="accueil")
     */

    public function accueil()
    {
        

        return $this->render("accueil.html.twig");
    }

    /**
     * @Route("/index1", name="index1")
     */
    public function index1()
    {
        

        return $this->render("a2s_conseil.html.twig");
    }

    /**
     * @Route("/index2", name="index2")
     */
    public function index2()
    {
        

        return $this->render("a2s_flandres.html.twig");
    }
    /**
     * @Route("/index3", name="index3")
     */
    public function index3()
    {
        

        return $this->render("histo.html.twig");
    }
}
?>