<?php

namespace App\Grabber\Services;

use App\Grabber\Services\Contracts\GrabberServiceInterface;
use App\Grabber\Services\Contracts\Model;
use App\Grabber\Validations\GrabberValidation;
use \Generator;

class GrabberService implements GrabberServiceInterface
{
    /** @var GrabberValidation  */
    protected $grabberValidation;

    /**
     * GrabberService constructor.
     * @param GrabberValidation $grabberValidation
     */
    public function __construct(GrabberValidation $grabberValidation) {
        $this->grabberValidation = $grabberValidation;
    }

    /**
     * @param array $data
     * @return array
     */
    public function capture(array $data): array
    {
        $summaryData = [];
        $this->grabberValidation->validateOnCapture($data);

        $page = env('APP_COUNT_OF_PAGES_FOR_GRABBER');
        while($page > 0) {

            $html = file_get_html($data['url'] . 'page/' . $page);

            $count = count($html->find('.listing-item'));
            $resultPage = $this->defaultArray($count);

            $links = $html->find('.listing-item div.listing-item-image-in a');
            foreach ($this->iteratingStrings($links, 'href') as $key => $value) {
                $resultPage[$key]['link'] = $value;
            }

            $images = $html->find('.listing-item div.listing-item-image-in img');
            foreach ($this->iteratingStrings($images, 'src') as $key => $value) {
                $resultPage[$key]['image'] = $value;
            }

            $titles = $html->find('.listing-item-main div.listing-item-title a');
            foreach ($this->iteratingStrings($titles, 'plaintext') as $key => $value) {
                $resultPage[$key]['title'] = $value;
            }

            $descriptions = $html->find('.listing-item-main div.listing-item-desc');
            foreach ($this->iteratingStrings($descriptions, 'plaintext') as $key => $value) {
                $resultPage[$key]['description'] = $value;
            }

            $messages = $html->find('.listing-item-main div.listing-item-message-in');
            foreach ($this->iteratingStrings($messages, 'plaintext') as $key => $value) {
                $resultPage[$key]['message'] = $value;
            }

            $ages = $html->find('.listing-item-price span');
            foreach ($this->iteratingStrings($ages, 'plaintext') as $key => $value) {
                $resultPage[$key]['age'] = $value;
            }

            $pricesRUB = $html->find('.listing-item-price strong');
            foreach ($this->iteratingStrings($pricesRUB, 'plaintext') as $key => $value) {
                $resultPage[$key]['price_rub'] = $value;
            }

            $pricesUSD = $html->find('.listing-item-price small');
            foreach ($this->iteratingStrings($pricesUSD, 'plaintext') as $key => $value) {
                $resultPage[$key]['price_usd'] = $value;
            }

            $locations = $html->find('.listing-item-price p.listing-item-location');
            foreach ($this->iteratingStrings($locations, 'plaintext') as $key => $value) {
                $resultPage[$key]['location'] = $value;
            }

            $html->clear();
            unset($html);
            $page--;

            $summaryData[] = $resultPage;
        }

        return $this->preparation($summaryData);
    }

    /**
     * @param int $count
     * @return array
     */
    private function defaultArray(int $count): array
    {
        $resultPage = [];
        for ($j = 0; $j < $count; $j++) {
            $resultPage[$j] = [
                'link' => null,
                'image' => null,
                'title' => null,
                'description' => null,
                'message' => null,
                'age' => null,
                'price_rub' => null,
                'price_usd' => null,
                'location' => null,
            ];
        }

        return $resultPage;
    }

    /**
     * @param array $data
     * @return array
     */
    private function preparation(array $data): array
    {
        $preparatoryData = [];
        foreach ($data as $key => $data) {
            $preparatoryData[$key] = [];
            foreach ($data as $item) {
                if (count($item) < 9) {
                    continue;
                }
                $preparatoryData[$key][] = $item;
            }
        }

        return $preparatoryData;
    }

    /**
     * @param array $data
     * @param string $search
     * @return Generator
     */
    private function iteratingStrings(array $data, string $search): Generator
    {
        foreach ($data as $key => $tag) {
            $result = '';
            foreach ($this->handlerRow(trim($tag->$search)) as $item) {
                $result .= $item;
            }

            yield $result;
        }
    }

    /**
     * @param string $str
     * @return Generator
     */
    private function handlerRow(string $str): Generator
    {
        $check = '';
        $length = strlen($str);
        for ($i = 0; $i <= $length - 1; $i++) {
            if ($check !== '' && $check === ' ' && $str[$i] === $check) {
                continue;
            }
            $check = $str[$i];

            yield $str[$i];
        }
    }
}
