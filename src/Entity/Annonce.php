<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use JMS\Serializer\Annotation as Serialiser;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AnnonceRepository")
 * @Serialiser\ExclusionPolicy("ALL")
 */
class Annonce
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Serialiser\Expose()
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Serialiser\Expose()
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     * @Serialiser\Expose()
     */
    private $content;

    /**
     * @ORM\Column(type="float")
     * @Serialiser\Expose()
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Categorie",inversedBy="annonce")
     * @Serialiser\Expose()
     */
    private $categorie;

    /**
     * Annonce constructor.
     */
    public function __construct()
    {
    }


    /**
     * @param array $param
     * @throws Exception
     */
    public function setDefault(array $param)
    {

        $param['createdAt'] = new DateTime();
        $this->hydrate($param);
    }

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function hydrate(array $element)
    {
        // Browse this array
        foreach ($element as $key => $value) {
            // We recover the setter name
            $method = 'set' . ucfirst($key);
            // If setter exist
            if (method_exists($this, $method)) {
                // We call the corresponding setter and hydrate it
                $this->$method($value);
            }
        }
    }

    /**
     * @return mixed
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * @param mixed $categorie
     */
    public function setCategorie($categorie): void
    {
        $this->categorie = $categorie;
    }
}
