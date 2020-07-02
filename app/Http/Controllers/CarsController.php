<?php

namespace App\Http\Controllers;

use App\Grabber\Services\Contracts\CarsServiceInterface;

class CarsController
{
    /** @var CarsServiceInterface  */
    protected $carsService;

    /**
     * CarsController constructor.
     * @param CarsServiceInterface $carsService
     */
    public function __construct(CarsServiceInterface $carsService)
    {
        $this->carsService = $carsService;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view()
    {
        $cars = $this->carsService->cars();

        if (!$cars) {
            return view('cars')->with(['cars' => []]);
        }

        return view('cars')->with(['cars' => $cars]);
    }
}
