<?php

namespace Lewy\DataMapper;

use Lewy\DataMapper\Entity;
use Lewy\DataMapper\Repository;
use Lewy\DataMapper\EntityCollection;

abstract class Service
{
    /**
     * @var Repository
     */
    protected Repository $repository;

    function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $id
     * 
     * @return Entity
     */
    public function getResourceById(int $id): Entity
    {
        return $this->repository->findById($id)->entity();
    }

    /**
     * @param int $userId
     * @param int $resourceId
     * 
     * @return bool
     */
    public function resourceBelongsToUser(int $userId, int $resourceId): bool
    {
        return $this->repository->where([
            'id'        => $resourceId,
            'user_id'   => $userId
        ])->count() === 1;
    }

    /**
     * @param int $userId
     * 
     * @return EntityCollection
     */
    public function getResourcesByUserId(int $userId): EntityCollection
    {
        return $this->repository->where(['user_id' => $userId])->entityCollection();
    }

    /**
     * @return EntityCollection
     */
    public function getResources(): EntityCollection
    {
        return $this->repository->findAll()->entityCollection();
    }

    /**
     * @param array $data
     * 
     * @return Entity
     */
    public function createResource(array $data): Entity
    {
        return $this->repository->create($data);
    }

    /**
     * @param array $data
     * 
     * @return Entity
     */
    public function updateResource(array $data): Entity
    {
        return $this->repository->update($data);
    }

    /**
     * @param array $data
     * 
     * @return Entity
     */
    public function deleteResource(int $id): Entity
    {
        return $this->repository->delete($id);
    }
}