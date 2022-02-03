<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ResultsController extends AbstractController
{

    #[Route('/results', name: 'results')]
    public function search(RequestStack $requestStack, HttpClientInterface $client): Response
    {
        $baseUrl = "https://api.themoviedb.org/3/";
        $type = $requestStack->getMainRequest()->query->get("type");
        $apiKey = "5ebe0843b2e373ffa159f5683b21b7de";
        $lang = "en-US";
        $search = $requestStack->getMainRequest()->query->get("search");
        $page = "1";
        $url = $baseUrl."search/".$type."?api_key=".$apiKey."&language=".$lang."&query=".$search."&page=".$page;
        $response = $client->request(
            'GET',
            $url
        );
        $response = json_decode($response->getContent(), true);
        $page = $response["page"];
        $results = $response["results"];
        $total_pages = $response["total_pages"];
        $total_results = $response["total_results"];


        return $this->render('search/index.html.twig', [
            "type" => $type,
            "search" => $search,
            "page" => $page,
            "results" => $results,
            "total_pages" => $total_pages,
            "total_results" => $total_results
        ]);
    }


    #[Route('/movies/{id}', name: 'movie')]
    public function singleMovie($id, RequestStack $requestStack, HttpClientInterface $client)
    {
        $baseUrl = "https://api.themoviedb.org/3/";
        $apiKey = "5ebe0843b2e373ffa159f5683b21b7de";
        $lang = "en-US";
        $url = $baseUrl."movie/$id"."?api_key=".$apiKey."&language=".$lang;
        $response = $client->request(
            'GET',
            $url
        );
        $response = json_decode($response->getContent(), true);
        //dump($response);die();
        return $this->render('search/single.html.twig', [
            "results" => $response
        ]);
    }
}