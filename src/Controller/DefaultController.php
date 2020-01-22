<?php


namespace App\Controller;


use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class DefaultController extends AbstractController
{

    public function index_name($name)
    {
        return $this->render('autre/helloworld.html.twig', ['name' => $name]);
    }

    public function accueil(ContainerInterface $container)
    {
        $annonces = $container->get('app.annonces_manager')->getAll();
        $cat = $container->get('app.categories_manager')->getAll();
        return $this->render('front/acceuil.html.twig', ['annonces' => $annonces,'categories'=>$cat]);
    }

    public function ajoutAnnonce(ContainerInterface $container)
    {
        return $this->render('front/ajoutAnnonce.html.twig');
    }

    public function formulaireAjout(ContainerInterface $container, Request $request)
    {
        $token = $request->get('token');
        if ($this->isCsrfTokenValid('formulaire_ajout', $token)) {

            $param = $request->request->all();
            $container->get('app.annonces_manager')->create($param);
            return new Response("success");

        } else {
            return new Response("error");
        }
    }

    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // retrouver une erreur d'authentification s'il y en a une
        $error = $authenticationUtils->getLastAuthenticationError();
        // retrouver le dernier identifiant de connexion utilisé
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('front/identification.html.twig', ['last_username' => $lastUsername, 'error' => $error,]);
    }
}