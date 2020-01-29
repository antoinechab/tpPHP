<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{

    public function index_name($name)
    {
        return $this->render('autre/helloworld.html.twig', ['name' => $name]);
    }

}