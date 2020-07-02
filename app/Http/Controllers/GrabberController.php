<?php

namespace App\Http\Controllers;

use App\Grabber\Services\Contracts\CarsServiceInterface;
use App\Grabber\Services\Contracts\GrabberServiceInterface;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class GrabberController
{
    /** @var GrabberServiceInterface  */
    protected $grabberService;

    /** @var CarsServiceInterface  */
    protected $carsService;

    /**
     * GrabberController constructor.
     * @param GrabberServiceInterface $grabberService
     * @param CarsServiceInterface $carsService
     */
    public function __construct(
        GrabberServiceInterface $grabberService,
        CarsServiceInterface $carsService
    ) {
        $this->grabberService = $grabberService;
        $this->carsService = $carsService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function capture(Request $request)
    {
        $data = $request->input();

        try {
            $captureData = $this->grabberService->capture($data);

            if ($this->carsService->create($captureData)) {
                return redirect()->to('cars');
            }
        } catch (NotFoundHttpException $exception) {
            return redirect()->back()->withInput()->with(['errors' => $exception->getMessage()]);
        } catch (BadRequestHttpException $exception) {
            return redirect()->back()->withInput()->with(['errors' => $exception->getMessage()]);
        }

    }
}
