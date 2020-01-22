<?php

namespace App\Service;

use App\Entity\Categorie;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Exception;
use Psr\Container\ContainerInterface;

class CategoriesManager
{
    /**
     * @var ContainerInterface
     */
    private $container;
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var EntityRepository
     */
    private $repository;


    /**
     * CategorieManager constructor.
     * @param ContainerInterface $_container
     */
    public function __construct(ContainerInterface $_container)
    {
        $this->container = $_container;
        $this->entityManager = $_container->get('doctrine.orm.entity_manager');
        $this->repository = $this->entityManager->getRepository(Categorie::class);
    }


    /**
     * @return Categorie|null
     * @throws Exception
     */
    public function create()
    {
        $element = new Categorie();
        $element->setDefault();

        if (!$this->update($element))
            return null;
        return $element;
    }

    /**
     * @param Categorie $element
     * @return bool
     */
    public function update(Categorie $element): bool
    {
        return $this->quickUpdate($element);
    }


    /**
     * @param Categorie $element
     * @return bool
     */
    public function quickUpdate(Categorie $element): bool
    {
        try {
            if (!$this->entityManager->contains($element)) {
                $this->entityManager->persist($element);
            }
            $this->entityManager->flush();
        } catch (OptimisticLockException $e) {
            return false;
        } catch (ORMException $e) {
            return false;
        }
        return true;
    }


    /**
     * @param int $id
     * @return Categorie|null
     */
    public function getById(int $id): ?Categorie
    {
        return $this->repository->findOneBy(['id' => $id]);
    }


    public function getAll()
    {
        return $this->repository->findAll();
    }

}
