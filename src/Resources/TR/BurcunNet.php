<?php
/**
 * Created by PhpStorm.
 * User: stablemobile09
 * Date: 7.09.2018
 * Time: 12:22
 */

namespace ismailcaakir\Astrology\Resources\TR;

use Goutte\Client;
use ismailcaakir\Astrology\Resources\Resources;

class BurcunNet extends Resources
{
    /**
     * @var
     */
    public $response;

    /**
     *
     */
    const BASE_URL = "http://burcun.net";

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
     */
    public function getResponse()
    {
        $this->init();

        $this->fetch();

        return $this->response;
    }

    /**
     * @return $this
     */
    private function fetch()
    {
        $data = $this->goutteClient->request(self::METHOD,$this->horoscopeResourceLinkGenerate());

        $parse = $data->filter('p');

        foreach ($parse as $index => $item) {

            switch ($index){
                case 1:
                    $this->response["daily"] = $this->helper->clearHtml($item->nodeValue);
                    break;
                case 3:
                    $this->response["love"] = $this->helper->clearHtml($item->nodeValue);
                    break;
                case 5:
                    $this->response["career"] = $this->helper->clearHtml($item->nodeValue);
                    break;
                case 7:
                    $this->response["health"] = $this->helper->clearHtml($item->nodeValue);
                    break;
                default:
                    //
            }

        }

        return $this;
    }


    /**
     * @return \Illuminate\Config\Repository|mixed
     */
    private function horoscopeResourceLinkGenerate()
    {
        $slug = sprintf("%s/%s-burcu.html",
            self::BASE_URL,
            $this->horoscope
        );

        // stump general response
        $this->response["resource_link"] = $slug;
        $this->response["date"]          = today();
        $this->response["language"]      = self::LANGUAGE;

        return $slug;
    }
}
