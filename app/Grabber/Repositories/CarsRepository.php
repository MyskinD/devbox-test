<?php

namespace App\Grabber\Repositories;

use App\Grabber\Repositories\Contracts\CarsRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class CarsRepository implements CarsRepositoryInterface
{
    /**
     * @param array $allCars
     * @return bool
     */
    public function saveMany(array $allCars): bool
    {
        $i = 0;
        $data = [];
        foreach ($allCars as $onOnePage) {
            foreach ($onOnePage as $car) {
                $data[$i] = $car;
                $i++;
            }
        }

        if (!DB::table('cars')->insert($data)) {
            return false;
        }

        return true;
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|Collection
     */
    public function all()
    {
        return DB::table('cars')->paginate(env('DB_PAGINATION'));
    }
}
