<?php

namespace App\Controller;

use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AccueilController extends AbstractController
{
    public function accueil(ContainerInterface $container)
    {
        $annonces = $container->get('app.annonces_manager')->getAll();
        return $this->render('front/acceuil.html.twig', ['annonces' => $annonces]);
    }

    public function filtrage(Request $request, ContainerInterface $container)
    {
        $token = $request->get('token');
        if ($this->isCsrfTokenValid('filtrage', $token)){
            //TODO: remplacer le getbyid par un get par cat
            $annoncesFiltred = $container->get('app.annonces_manager')->getByCat($request->get('id'));
            $this->render('front/listAnnonces.twig',['annoncesFiltred' => $annoncesFiltred]);
            return new Response("success");
        }
        return new Response("erreur de filtrage");
    }
}