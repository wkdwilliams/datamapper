<?php

namespace Core\Traits;

use Illuminate\Http\JsonResponse;

trait CreateResourceWithAuthId
{

    /**
     * Create resource
     * @return JsonResponse
     */
    public function store(): JsonResponse
    {
        $this->request->request->remove('user_id');
        $this->request->request->add([
            'user_id' => $this->authenticatedUser->id
        ]);

        return parent::store();
    }

}