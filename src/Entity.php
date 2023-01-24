<?php

namespace Lewy\DataMapper;

use Illuminate\Support\Str;

abstract class Entity
{

    /**
     * @var ?int
     */
    protected ?int $id = null;

    /**
     * @var ?string
     */
    protected ?string $createdAt = null;

    /**
     * @var ?string
     */
    protected ?string $updatedAt = null;

    /**
     * @return ?int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return ?string
     */
    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    /**
     * @param string $createdAt
     */
    public function setCreatedAt(string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return ?string
     */
    public function getUpdatedAt(): ?string
    {
        return $this->updatedAt;
    }

    /**
     * @param string $updatedAt
     */
    public function setUpdatedAt(string $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @param array $data
     * @return Entity
     */
    public function populate(array $data): Entity
    {
        foreach ($data as $key => $value)
        {
            $this->{Str::camel('set_' . $key)}($value);
        }

        return $this;
    }

}
