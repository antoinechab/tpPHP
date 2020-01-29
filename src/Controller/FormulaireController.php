<?php


namespace App\Controller;


use App\Classe\TypeFormAjout;
use App\Entity\Annonce;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class FormulaireController extends AbstractController
{
    public function new(Request $request)
    {
        $annonce = new Annonce();

        $form = $this->createForm(TypeFormAjout::class, $annonce);//annonceType

        return $this->render('front/ajoutAnnonce.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}