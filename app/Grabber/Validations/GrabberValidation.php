<?php

namespace App\Grabber\Validations;


class GrabberValidation extends Validation
{
    /**
     * @param array $data
     */
    public function validateOnCapture(array $data): void
    {
        $this->isNotNull($data['url'], 'url');
        $this->isRegExp('/^https:\/\/cars.av.by\/$/', $data['url'], 'url');

    }
}
