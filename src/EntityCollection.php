<?php

namespace Lewy\DataMapper;

use Illuminate\Support\Collection;

class EntityCollection
{
    /**
     * @var array
     */
    private array $entities;

    /**
     * @var array
     */
    private array $paginateData = [];

    public function __construct(array $entities = [])
    {
        $this->entities = $entities;
    }

    /**
     * Push an entity to the collection
     * 
     * @param Entity $entity
     * 
     * @return EntityCollection
     */
    public function push(Entity $entity): EntityCollection
    {
        $this->entities[] = $entity;

        return $this;
    }

    /**
     * Empty the collection
     * 
     * @return EntityCollection
     */
    public function empty(): EntityCollection
    {
        $this->entities = [];

        return $this;
    }

    /**
     * Get the entities
     * 
     * @return array
     */
    public function getEntities(): array
    {
        return $this->entities;
    }

    /**
     * Convert entity collection to laravel collection
     * 
     * @return Collection
     */
    public function toLaravelCollection(): Collection
    {
        return new Collection($this->entities);
    }

    /**
     * Get the count of entities
     * @return int
     */
    public function count(): int
    {
        return count($this->entities);
    }

    /**
     * Get paginated data of this entity collection
     * 
     * @return array
     */
    public function getPaginatedData(): array
    {
        return $this->paginateData;
    }

    /**
     * Set paginated data of this entity collection
     * @param array $paginateData
     * 
     * @return void
     */
    public function setPaginatedData(array $paginateData): void
    {
        $this->paginateData = $paginateData;
    }


}
