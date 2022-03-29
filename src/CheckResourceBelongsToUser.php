<?php

namespace Core\Traits;

use Core\Exceptions\PermissionDeniedException;
use Illuminate\Http\JsonResponse;

trait CheckResourceBelongsToUser
{
    
    /**
     * Get resource by id
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        if(!$this->service->resourceBelongsToUser($this->authenticatedUser->id, $id))
            throw new PermissionDeniedException();
        
        return parent::show($id);
    }

    /**
     * Get all resources
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $repos = $this->service->getResourcesByUserId($this->authenticatedUser->id);

        return $this->response(
            new $this->classes['collection']($repos)
        );
    }

    /**
     * Update resource
     * @return JsonResponse
     */
    public function update(int $id): JsonResponse
    {
        if(!$this->service->resourceBelongsToUser($this->authenticatedUser->id, $id))
            throw new PermissionDeniedException();

        return parent::update($id);
    }

    /**
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        if(!$this->service->resourceBelongsToUser($this->authenticatedUser->id, $id))
            throw new PermissionDeniedException();

        return parent::destroy($id);
    }
}