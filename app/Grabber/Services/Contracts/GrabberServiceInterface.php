<?php

namespace App\Grabber\Services\Contracts;


interface GrabberServiceInterface
{
    /**
     * @param array $data
     * @return array
     */
    public function capture(array $data): array;
}
