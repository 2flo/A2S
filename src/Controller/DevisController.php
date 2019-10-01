<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Entity\Formation;
use App\Entity\Situation;
use App\Form\FormationType;
use App\Repository\UserRepository;
use App\Repository\FormationRepository;
use App\Repository\SituationRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DevisController extends AbstractController
{
    /**
     * @Route("/devis", name="devis", methods={"GET","POST"})
     */
    public function index( Request $request):Response
    {
       $user = new User();
    //    $formations= $this->getDoctrine()->getManager()->getRepository(Formation::class)->findAll();
    //     $situations= $this->getDoctrine()->getManager()->getRepository(Situation::class)->findAll();

        $users= $this->getDoctrine()->getManager()->getRepository(User::class)->findAll();

        $formUser = $this->createForm(UserType::class, $user);
        $formUser->handleRequest($request);

        if ($formUser->isSubmitted() && $formUser->isValid()) {
           
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('devis');
        }


        return $this->render('devis/devis.html.twig', [
            'controller_name' => 'DevisController',
            // 'formations' => $formations,
            // 'situations' =>$situations,
            'users' =>$users,
            'formUser' => $formUser->createView()
        ]);
    }
}
