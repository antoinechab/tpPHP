<?php

namespace App\Service;

use App\Entity\Annonce;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Exception;
use Psr\Container\ContainerInterface;

class AnnoncesManager
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
     * AnnonceManager constructor.
     * @param ContainerInterface $_container
     */
    public function __construct(ContainerInterface $_container)
    {
        $this->container = $_container;
        $this->entityManager = $_container->get('doctrine.orm.entity_manager');
        $this->repository = $this->entityManager->getRepository(Annonce::class);
    }


    /**
     * @param array $param
     * @return Annonce|null
     * @throws Exception
     */
    public function create(array $param)
    {
        $element = new Annonce();
        $element->setDefault($param);

        if (!$this->update($element))
            return null;
        return $element;
    }

    /**
     * @param Annonce $element
     * @return bool
     */
    public function update(Annonce $element): bool
    {
        return $this->quickUpdate($element);
    }


    /**
     * @param Annonce $element
     * @return bool
     */
    public function quickUpdate(Annonce $element): bool
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
     * @return Annonce|null
     */
    public function getById(int $id): ?Annonce
    {
        return $this->repository->findOneBy(['id' => $id]);
    }



    public function getByCat(int $id)
    {
        return $this->repository->findAllByCat($id);
//        return $this->repository->findAll(['categorie' => $id]);
    }


    public function getAll()
    {
        return $this->repository->findAll();
    }

}
