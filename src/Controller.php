<?php

namespace Lewy\DataMapper;

use Lewy\DataMapper\Model;
use Lewy\DataMapper\Service;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * @var array
     */
    protected array $classes;

    /**
     * @var Service
     */
    protected Service $service;

    /**
     * @var Request
     */
    protected Request $request;

    /**
     * The validation rules we want when updating a resource
     * @var array
     */
    protected array $updateRules = [];

    /**
     * The validation rules we want when creating a resource
     * @var array
     */
    protected array $createRules = [];

    /**
     * The amount of pagination we want to use
     * when getting multiple recourds
     * @var int
     */
    protected int $paginate = 0;

    /**
     * This gives us quick access to the authenticated user
     * @var Model|null
     */
    protected ?Model $authenticatedUser;

    /**
     * Controller constructor.
     * 
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->authenticatedUser = auth()->user();
        $this->request           = $request;

        $this->service = new $this->classes['service'](
            new $this->classes['repository'](
                $this->paginate,
                $this->request->get('page') ?? 1
            )
        );
    }

    /**
     * Return response of our resource
     * 
     * @param JsonResource $resource
     * 
     * @return JsonResponse
     */
    protected function response(JsonResource $resource, array $paginateData=null, int $status=200): JsonResponse
    {
        return response()->json([
            'status' => $status,
            'data'   => $resource,
            ...$paginateData ?? []
        ], $status);
    }

    /**
     * Get resource by id
     * 
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $repos = $this->service->getResourceById($id);

        return $this->response(
            new $this->classes['resource']($repos)
        );
    }

    /**
     * Get all resources
     * 
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $repos = $this->service->getResources();

        return $this->response(
            new $this->classes['collection']($repos), $repos->getPaginatedData()
        );
    }

    /**
     * Create resource
     * 
     * @return JsonResponse
     */
    public function store(): JsonResponse
    {
        $repos = $this->service->createResource([
            'user_id' => $this->authenticatedUser->id ?? null,
            ...$this->request->validate($this->createRules)
        ]);

        return $this->response(
            new $this->classes['resource']($repos), null, 201
        );
    }

    /**
     * Update resource
     * 
     * @return JsonResponse
     */
    public function update(int $id): JsonResponse
    {
        $repos = $this->service->updateResource([
            'id'        => $id,
            'user_id'   => $this->authenticatedUser->id ?? null,
            ...$this->request->validate($this->updateRules)
        ]);

        return $this->response(
            new $this->classes['resource']($repos)
        );
    }

    /**
     * Delete resource
     * 
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $repos = $this->service->deleteResource($id);

        return $this->response(
            new $this->classes['resource']($repos)
        );
    }

}
