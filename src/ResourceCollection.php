<?php

namespace Lewy\DataMapper;

use Lewy\DataMapper\EntityCollection;
use Illuminate\Http\Resources\Json\ResourceCollection as Collection;

class ResourceCollection extends Collection
{
    public function __construct($resource)
    {
        // If we've got an Entity Collection, convert it into a Laravel one
        if ($resource instanceof EntityCollection) {
            $resource = $resource->toLaravelCollection();
        }

        parent::__construct($resource);
    }
}