<?php


namespace App\Controller;


use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AjoutController extends AbstractController
{

    public function ajoutAnnonce(ContainerInterface $container)
    {
//        return $this->redirectToRoute(FormulaireController::class);
        return $this->render('front/ajoutAnnonce.html.twig');
    }

    public function formulaireAjout(ContainerInterface $container, Request $request)
    {
        $token = $request->get('token');
        if ($this->isCsrfTokenValid('formulaire_ajout', $token)) {

            $param = $request->request->all();
            try {
                $container->get('app.annonces_manager')->create($param);
            } catch (\Exception $e) {
                dump('exception dans la créa du form d\'ajout: '.$e.'');
            }
            return new Response("success");

        } else {
            return new Response("error");
        }
    }

}