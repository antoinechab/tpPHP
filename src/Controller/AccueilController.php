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
//        dump($annonces);
        return $this->render('front/acceuil.html.twig', ['annonces' => $annonces]);
    }

    public function filtrage(Request $request, ContainerInterface $container)
    {
        $token = $request->get('token');
        if ($this->isCsrfTokenValid('filtrage', $token))
        {
            /*//TODO: remplacer le getbyid par un get par cat
            //TODO: vérifier les return ici ils semblent null
            dump($request->get('id'));
            $annoncesFiltred = $container->get('app.annonces_manager')->getByCat($request->get('id'));
            $this->render('front/listAnnonces.twig',['annoncesFiltred' => $annoncesFiltred]);
            dump($annoncesFiltred);
            return $this->render('front/acceuil.html.twig', ['annoncesFiltred' => $annoncesFiltred]);*/


            $annoncesFiltred = $container->get('app.annonces_manager')->getByCat($request->get('id'));

           /* $encoders = [new JsonEncoder()];
            $normalizers = [new ObjectNormalizer()];

            $serializer = new Serializer($normalizers, $encoders);*/

           $data = $this->get('jms_serializer')->serialize($annoncesFiltred,'json');


            dump($annoncesFiltred);
            dump($data);

            $response = new Response($data);
            $response->headers->set('Content-Type', 'application/json');

            return $response;
//            return $this->render('front/acceuil.html.twig', ['annoncesFiltred' => $annoncesFiltred]);
        }
        return new Response("erreur de filtrage");
    }
}