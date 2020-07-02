<?php

namespace App\Grabber\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface CarsRepositoryInterface
{
    /**
     * @return mixed
     */
    public function all();

    /**
     * @param array $data
     * @return mixed
     */
    public function saveMany(array $data): bool;
}
