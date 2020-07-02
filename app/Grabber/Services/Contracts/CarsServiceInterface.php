<?php

namespace App\Grabber\Services\Contracts;


interface CarsServiceInterface
{
    /**
     * @return object
     */
    public function cars(): object;

    /**
     * @param array $data
     * @return bool
     */
    public function create(array $data): bool;
}
