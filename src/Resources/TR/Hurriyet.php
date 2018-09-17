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

class Hurriyet extends Resources
{
    /**
     * @var
     */
    public $response;

    /**
     *
     */
    const BASE_URL = "http://mahmure.hurriyet.com.tr/astroloji/burclar";

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
     * @var
     */
    private $type;

    /**
     * @var
     */
    private $language;

    /**
     * @var array
     */
    public $invalidWords = [
        "https", "http"
    ];

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

        $parse = $data->filter('.horoscope-card-text > p');

        $this->response["comment"] = "";

        foreach ($parse as $key => $item)
        {

            if (!$this->deleteAllLineIfInvalidWords($this->invalidWords,$item->nodeValue))
            {
                $this->response["comment"] .= $item->nodeValue. " ";
            }
        }

        return $this;
    }


    /**
     * @return object
     */
    private function horoscopeResourceLinkGenerate()
    {
        //basak-burcu-gunluk-yorum
        $slug = sprintf("%s/%s-burcu-%s-yorum",
            self::BASE_URL,
            $this->horoscopeConverterToTurkish($this->horoscope),
            $this->type
        );

        // stump general response
        $this->response["resource_link"] = $slug;
        $this->response["date"]          = Carbon::today();
        $this->response["language"]      = self::LANGUAGE;

        return $slug;
    }

    private function typeConverter($type = null)
    {
        switch ($type){
            case "daily":
                return "gunluk";
                break;
            case "weekly":
                return "haftalik";
                break;
            case "monthly":
                return "aylik";
                break;
            case "yearly":
                return "yillik";
                break;
            default:
                return "gunluk";
        }
    }

    /**
     * Convert to turkish - english
     *
     * @param $horoscope
     * @return string
     */
    private function horoscopeConverterToTurkish($horoscope)
    {
        switch ($horoscope) {
            case "aries":
                return "koc";
                break;
            case "taurus":
                return "boga";
                break;
            case "gemini":
                return "ikizler";
                break;
            case "cancer":
                return "yengec";
                break;
            case "leo":
                return "aslan";
                break;
            case "virgo":
                return "basak";
                break;
            case "libra":
                return "terazi";
                break;
            case "scorpio":
                return "akrep";
                break;
            case "sagittarius":
                return "yay";
                break;
            case "capricorn":
                return "oglak";
                break;
            case "aquarius":
                return "kova";
                break;
            case "pisces":
                return "balik";
                break;
            default:
                return "virgo";
                break;
        }
    }
}
