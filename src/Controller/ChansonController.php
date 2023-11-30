<?php

namespace App\Controller;

use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChansonController extends AbstractController
{
    #[Route('/', name: 'app_chanson')]
    public function chansons(): Response
    {
        return $this->render('chanson/index.html.twig', [
            'Chansons' => 'ChansonController',
        ]);
    }

    #[Route('/chanson/ajouter', name: 'app_chanson_ajouter')]
    public function ajouter(): Response
    {
        return $this->render('chanson/ajouter.html.twig', [
            'ajouterChanson' => '{{ form(form) }}',
        ]);
    }
}
