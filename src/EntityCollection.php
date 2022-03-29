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

    public function push(Entity $entity): EntityCollection
    {
        $this->entities[] = $entity;

        return $this;
    }

    public function empty(): EntityCollection
    {
        $this->entities = [];

        return $this;
    }

    public function getEntities(): array
    {
        return $this->entities;
    }

    public function toLaravelCollection(): Collection
    {
        return new Collection($this->entities);
    }

        /**
     * @return array
     */
    public function getPaginatedData(): array
    {
        return $this->paginateData;
    }

    /**
     * @param array $paginateData
     * 
     * @return void
     */
    public function setPaginatedData(array $paginateData): void
    {
        $this->paginateData = $paginateData;
    }


}
