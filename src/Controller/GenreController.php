<?php

namespace App\Controller;

use App\Entity\Genre;
use App\Form\GenreType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GenreController extends AbstractController
{
    #[Route('/genres', name: 'app_genre')]
    public function genres(EntityManagerInterface $entityManager): Response
    {
        $repository = $entityManager->getRepository(Genre::class);
        $genres = $repository->findAll();
        return $this->render('genre/index.html.twig', [
            'genres' => $genres,
        ]);
    }

    #[Route('/genre/ajouter', name: 'app_genre_ajouter')]
    public function ajouter(Request $request, EntityManagerInterface $entityManager): Response
    {
        // creates object
        $genre = new Genre();
        // creates form
        $form = $this->createForm(GenreType::class, $genre);
        // capture request
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $genre = $form->getData();
            // Saving in DB
            $entityManager->persist($genre);
            $entityManager->flush();
            // redirect to home page
            return $this->redirectToRoute('app_genre');
        }

        return $this->render('chanson/ajouter.html.twig', [
            'form' => $form,
        ]);
    }
}
