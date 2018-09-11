<?php
/**
 * Created by PhpStorm.
 * User: stablemobile09
 * Date: 7.09.2018
 * Time: 12:22
 */

namespace ismailcaakir\Astrology\Resources\TR;

use Carbon\Carbon;
use ismailcaakir\Astrology\Resources\Resources;

class Mynet extends Resources
{
    /**
     * @var
     */
    public $response;

    /**
     *
     */
    const BASE_URL = "https://www.mynet.com/kadin/burclar-astroloji";

    /**
     *
     */
    const METHOD   = "GET";


    /**
     * Language
     */
    const LANGUAGE = "TR";

    /**
     * @var
     */
    private $horoscope;

    /**
     * @var Carbon
     */
    private $date;

    /**
     * @var
     */
    private $language;

    /**
     * @var array
     */
    public $invalidWords = [
        "https", "iremSU", "Not", "Mynet", "mynet", "instagram", "twitter", "Twitter", "Instagram", "İnstagram"
    ];

    /**
     * BurcunNet constructor.
     * @param $horoscope
     * @param $date
     * @param $language
     */
    public function __construct($horoscope, $date, $language)
    {
        $this->init();

        $this->horoscope    = $horoscope;

        $this->date         = Carbon::parse($date);

        $this->language     = $language;
    }

    /**
     * @return mixed
     */
    public function getResponse()
    {
        $this->fetch();

        return $this->response;
    }

    /**
     * @return $this
     */
    private function fetch()
    {
        $data = $this->goutteClient->request(self::METHOD,$this->horoscopeResourceLinkGenerate());

        $parse = $data->filter('.detail-content-inner > p');

        $this->response["daily"] = "";

        foreach ($parse as $key => $item)
        {
            if (!$this->deleteAllLineIfInvalidWords($this->invalidWords,$item->nodeValue))
            {
                $this->response["daily"] .= $item->nodeValue;
            }
        }

        return $this;
    }


    /**
     * @return \Illuminate\Config\Repository|mixed
     */
    private function horoscopeResourceLinkGenerate()
    {
        $slug = sprintf("%s/%s-burcu-gunluk-yorumu.html?day=%s&month=%s&year=%s",
            self::BASE_URL,
            $this->horoscope,
            $this->helper->replaceWithStartZero($this->date->format('d')),
            $this->helper->replaceWithStartZero($this->date->format('m')),
            $this->helper->replaceWithStartZero($this->date->format('Y'))
        );

        // stump general response
        $this->response["resource_link"] = $slug;
        $this->response["date"]          = $this->date;
        $this->response["language"]      = self::LANGUAGE;

        return $slug;
    }



}
