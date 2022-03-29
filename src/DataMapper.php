<?php

namespace Lewy\DataMapper;

use Lewy\DataMapper\Entity;

abstract class DataMapper
{
    /**
     * @var Entity
     */
    protected $entity;

    /**
     * Constructor of the datamapper
     */
    public function __construct()
    {

    }

    /**
     * Used for populating an entity with data retrived from the repository
     * @param array $data
     * @return Entity
     */
    public function repoToEntity(array $data): Entity
    {
        return (new $this->entity)->populate($this->fromRepository($data));
    }

    /**
     * Used when populating an entity with array data
     * @param array $data
     * @return Entity
     */
    public function arrayToEntity(array $data): Entity
    {
        return (new $this->entity)->populate($this->toRepository($data));
    }

    /**
     * Used when converting an Entity to array data
     * @param Entity $entity
     * 
     * @return array
     */
    public function entityToArray(Entity $entity): array
    {
        return $this->fromEntity($entity);
    }

    /**
     * Used when converting multiple repository results to an entity collection
     * @param array $data
     * 
     * @return EntityCollection
     */
    public function repoToEntityCollection(array $data): EntityCollection
    {
        $collection = new EntityCollection();

        foreach ($data as $d)
        {
            $collection->push($this->repoToEntity($d));
        }

        return $collection;
    }

    /**
     * Used for mapping data from a repository
     * @param array $data
     * @return array
     */
    abstract protected function fromRepository(array $data): array;

    /**
     * Used for mapping data to a repository
     * @param array $data
     * @return array
     */
    abstract protected function toRepository(array $data): array;

    /**
     * Used for mapping data from an entity
     * @param array $data
     * @return array
     */
    abstract protected function fromEntity(Entity $entity): array;

}
