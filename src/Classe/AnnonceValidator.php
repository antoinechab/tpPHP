<?php


namespace App\Classe;

use Symfony\Component\Validator\Constraints as Assert;

class AnnonceValidator
{

    /**
     * @Assert\NotBlank()
     */
    private $title;

    /**
     * @Assert\NotBlank()
     */
    private $price;

    /**
     * @Assert\NotBlank()
     */
    private $content;

}