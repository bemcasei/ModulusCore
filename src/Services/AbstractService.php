<?php

namespace ModulusCore\Services;

use Doctrine\ORM\EntityManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\Hydrator\HydratorInterface;
use Zend\Math\Rand;

/**
 * Abstract class insert, update, delete
 *
 * @category ModulusCore
 * @package Services
 * @author William Hoffmann <williamhoffmann@outlook.com>
 */
class AbstractService implements ServiceInterface
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @var $hydrator
     */
    protected $hydrator;

    /**
     * @var $entity
     */
    protected $entity;

    /**
     * Constructor
     *
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Fetch for record according to parameter token
     *
     * @param $token
     * @return object
     * @throws \Doctrine\ORM\ORMException
     */
    public function findOneByToken($token)
    {
        $repository = $this->entityManager->getRepository($this->entity);
        $entity = $repository->findOneByToken($token);

        return $entity;
    }

    /**
     * Create new record
     *
     * @param $data
     * @return object
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function create($data)
    {
        if (is_array($data)) {
            $entityClass = $this->entity;
            $entity = new $entityClass();
            $entity->setToken(Md5(Rand::getBytes(8, true)));
            $this->getHydrator()->hydrate($data, $entity);
        } elseif (is_object($data)) {
            $entity = $data;
            $entity->setToken(Md5(Rand::getBytes(8, true)));
        } else {
            throw new \UnexpectedValueException(
                sprintf(
                    '$data expect to be an array or object, %s given',
                    gettype($data)
                )
            );
        }

        $this->entityManager->persist($entity);
        $this->entityManager->flush();

        return $entity;
    }

    /**
     * Update a record
     *
     * @param $data
     * @return bool|\Doctrine\Common\Proxy\Proxy|null|object
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function update($data)
    {
        if (is_array($data)) {
            $entity = $this->entityManager->getReference($this->entity, $data['id']);
            $this->getHydrator()->hydrate($data, $entity);
            //save the entity in database
            $this->entityManager->persist($entity);
        } elseif (is_object($data)) {
            $entity = $data;
            //update the object entity into the datatable
            $this->entityManager->merge($entity);
        } else {
            throw new \UnexpectedValueException(
                sprintf(
                    '$data expect to be an array or object, %s given',
                    gettype($data)
                )
            );
        }
        //commit
        $this->entityManager->flush();

        return $entity;
    }

    /**
     * Delete record
     *
     * @param $data
     * @return object|array
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete($value)
    {
        $id = null;
        if (is_array($value)) {
            foreach ($value as $id) {
                if (is_object($id)) {
                    $id = $id->getId();
                }
                $entity = $this->entityManager->getReference($this->entity, $id);
                if ($entity) {
                    $this->entityManager->remove($entity);
                }
            }
        } else {
            $id = $value;
            if (is_object($id)) {
                $id = $id->getId();
            }
            $entity = $this->entityManager->getReference($this->entity, $id);
            if ($entity) {
                $this->entityManager->remove($entity);
            }
        }
        $this->entityManager->flush();

        return $id;
    }

    /**
     * Set hydrator
     *
     * @param HydratorInterface $hydrator
     * @return $this
     */
    public function setHydrator(HydratorInterface $hydrator)
    {
        $this->hydrator = $hydrator;

        return $this;
    }

    /**
     * Get hydrator
     *
     * @return DoctrineHydrator
     */
    public function getHydrator()
    {
        if (null == $this->hydrator) {
            $this->hydrator = new DoctrineHydrator($this->entityManager);
        }

        return $this->hydrator;
    }
}
