<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Formation;
use App\Entity\Situation;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DevisController extends AbstractController
{
    /**
     * @Route("/devis", name="devis")
     */
    public function index(Formation $formations = null, Situation $situation = null, User $user = null)
    {
        $formations = new Formation();
        $situation = new Situation();
        $user = new User();

        $formFormation = $this->createForm(FormationType::class, $formations);
        $formFormation->handleRequest($request);

        if ($formFormation->isSubmitted() && $formFormation->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($formations);
            $entityManager->flush();

            return $this->redirectToRoute('formation_index');
        }


        return $this->render('devis/devis.html.twig', [
            'controller_name' => 'DevisController',
            'formations' => $formations,
            'situations' =>$situation,
            'users' =>$user,
            'formFormation' => $formFormation
        ]);
    }
}
