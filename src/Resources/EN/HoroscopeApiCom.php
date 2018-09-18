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
    const BASE_URL = "http://horoscope-api.herokuapp.com/horoscope";

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

    /**
     * @var
     */
    private $type;

    /**
     * @var
     */
    private $language;

    /**
     * BurcunNet constructor.
     * @param $horoscope
     * @param $type
     * @param $language
     */
    public function __construct($horoscope, $type, $language)
    {
        $this->horoscope    = $horoscope;
        $this->type         = $this->typeConverter($type);
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

        $this->response["comment"] = $data->horoscope;

        return $this;
    }


    /**
     * @return object
     */
    private function horoscopeResourceLinkGenerate()
    {
        $slug = sprintf("%s/%s/%s",
            self::BASE_URL,
            $this->type,
            $this->horoscope
        );

        // stump general response
        $this->response["resource_link"] = $slug;
        $this->response["date"]          = Carbon::today();
        $this->response["language"]      = self::LANGUAGE;

        return $slug;
    }

    /**
     * @param null $type
     * @return string
     */
    private function typeConverter($type = null)
    {
        switch ($type){
            case "daily":
                return "today";
                break;
            case "weekly":
                return "week";
                break;
            case "monthly":
                return "month";
                break;
            case "yearly":
                return "year";
                break;
            default:
                return "today";
        }
    }
}
