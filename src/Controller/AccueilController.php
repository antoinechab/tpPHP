<?php


namespace App\Controller;


use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccueilController extends AbstractController
{

    public function accueil(ContainerInterface $container)
    {
        $annonces = $container->get('app.annonces_manager')->getAll();
        $cat = $container->get('app.categories_manager')->getAll();
        return $this->render('front/acceuil.html.twig', ['annonces' => $annonces,'categories'=>$cat]);
    }

}