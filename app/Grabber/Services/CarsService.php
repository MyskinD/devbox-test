<?php

namespace App\Grabber\Services;

use App\Grabber\Repositories\Contracts\CarsRepositoryInterface;
use App\Grabber\Services\Contracts\CarsServiceInterface;
use App\Grabber\Services\Contracts\Model;

class CarsService implements CarsServiceInterface
{
    /** @var CarsRepositoryInterface  */
    protected $carsRepository;

    /**
     * GrabberService constructor.
     * @param CarsRepositoryInterface $carsRepository
     */
    public function __construct(CarsRepositoryInterface $carsRepository)
    {
        $this->carsRepository = $carsRepository;
    }

    /**
     * @return object
     */
    public function cars(): object
    {
        return $this->carsRepository->all();
    }

    /**
     * @param array $data
     * @return bool
     */
    public function create(array $data): bool
    {
        if (!$this->carsRepository->saveMany($data)) {
            return false;
        }

        return true;
    }
}
