<?php
/**
 * Created by PhpStorm.
 * User: stablemobile09
 * Date: 7.09.2018
 * Time: 12:22
 */

namespace ismailcaakir\Astrology\Resources\EN;

use Carbon\Carbon;
use ismailcaakir\Astrology\Resources\Resources;

class HoroscopeApiCom extends Resources
{
    /**
     * @var
     */
    public $response;

    /**
     *
     */
    const BASE_URL = "http://horoscope-api.herokuapp.com/horoscope/today";

    /**
     *
     */
    const METHOD   = "GET";


    /**
     * Language
     */
    const LANGUAGE = "EN";

    /**
     * @var
     */
    private $horoscope;
    private $date;
    private $language;

    /**
     * BurcunNet constructor.
     * @param $horoscope
     * @param $date
     * @param $language
     */
    public function __construct($horoscope, $date, $language)
    {
        $this->horoscope    = $horoscope;
        $this->date         = $date;
        $this->language     = $language;
    }

    /**
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getResponse()
    {
        $this->init();

        $this->fetch();

        return $this->response;
    }

    /**
     * @return $this
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function fetch()
    {
        $data = json_decode($this->guzzleClient->request(self::METHOD,$this->horoscopeResourceLinkGenerate())->getBody()->getContents());

        $this->response["daily"] = $data->horoscope;

        return $this;
    }


    /**
     * @return object
     */
    private function horoscopeResourceLinkGenerate()
    {
        $slug = sprintf("%s/%s",
            self::BASE_URL,
            $this->helper->horoscopeConverterToEnglish($this->horoscope)
        );

        // stump general response
        $this->response["resource_link"] = $slug;
        $this->response["date"]          = Carbon::today();
        $this->response["language"]      = self::LANGUAGE;

        return $slug;
    }
}
