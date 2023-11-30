<?php

namespace App\Controller;

use App\Entity\Chanson;
use App\Form\ChansonType;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChansonController extends AbstractController
{
    #[Route('/', name: 'app_chansons')]
    public function chansons(EntityManagerInterface $entityManager): Response
    {
        $repository = $entityManager->getRepository(Chanson::class);
        $chansons = $repository->findAll();
        return $this->render('chanson/index.html.twig', [
            'Chansons' => $chansons,
        ]);
    }

    #[Route('/chanson/{id}', name: 'app_chanson')]
    public function chanson(Chanson $chanson): Response
    {
        return $this->render('chanson/chanson.html.twig', [
            'chanson' => $chanson,
        ]);
    }


    #[Route('/chanson/ajouter', name: 'app_chanson_ajouter')]
    public function ajouter(Request $request, EntityManagerInterface $entityManager): Response
    {
        // creates object
        $chanson = new Chanson();
        // creates form
        $chanson->setDateAjout(new DateTime());
        $form = $this->createForm(ChansonType::class, $chanson);
        // capture request
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $chanson = $form->getData();
            // Saving in DB
            $entityManager->persist($chanson);
            $entityManager->flush();
            // redirect to home page
            return $this->redirectToRoute('app_chansons');
        }

        return $this->render('chanson/ajouter.html.twig', [
            'form' => $form,
        ]);
    }
}
