<?php

namespace App\Controller;

use App\Entity\FavoritesList;
use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class FavoritesController extends AbstractController
{
    #[Route('/favorites', name: 'favorites')]
    public function listFavorites(ManagerRegistry $doctrine): Response
    {

        $favoriteListInDB = $doctrine->getRepository(FavoritesList::class)->findAll();

        return $this->render('favorites/index.html.twig', [
            'favoriteList' => $favoriteListInDB,
        ]);
    }

    #[Route('/favorites/add/{id}', name: 'favoritesAdd')]
    public function addFavorite(ManagerRegistry $doctrine, $id, RequestStack $requestStack): Response
    {
        $favoriteListInDB = $doctrine->getRepository(FavoritesList::class)->find($id);
        //$favoriteListInDB = $doctrine->getRepository(FavoritesList::class)->findBy(array("movieID" => $id));
        //dump($favoriteListInDB);die();
        $entityManager = $doctrine->getManager();
        $favoriteList = new FavoritesList();
        $favoriteList -> setDateAdded( new \DateTime());
        $favoriteList -> setMovieID($id);
        $favoriteList -> setMovieTitle($requestStack->getMainRequest()->query->get("title"));
        $entityManager->persist($favoriteList);
        $entityManager->flush();

        return $this->redirectToRoute("favorites");
    }

    #[Route('/favorites/delete/{id}', name: 'favoritesDelete')]
    public function deleteFavorite(ManagerRegistry $doctrine, $id): Response
    {
        $entityManager = $doctrine->getManager();
        $favoriteList = $doctrine->getRepository(FavoritesList::class)->find($id);

        $entityManager->remove($favoriteList);
        $entityManager->flush();

        return $this->redirectToRoute("favorites");
    }
}
