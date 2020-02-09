<?php

namespace App\Controller;

use App\Classe\AnnonceType;
use App\Entity\Annonce;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class FormulaireController extends AbstractController
{
    public function new(Request $request)
    {
        $annonce = new Annonce();

        $form = $this->createForm(AnnonceType::class, $annonce);

        return $this->render('front/ajoutAnnonce.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}