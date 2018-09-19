<?php
/**
 * Created by PhpStorm.
 * User: stablemobile09
 * Date: 7.09.2018
 * Time: 12:22
 */

namespace ismailcaakir\Astrology\Resources\FR;

use Carbon\Carbon;
use ismailcaakir\Astrology\Resources\Resources;

class Sympatico extends Resources
{
    /**
     * @var
     */
    public $response;

    /**
     *
     */
    const BASE_URL = "http://www.sympatico.ca/horoscope/traditionnel";

    /**
     *
     */
    const METHOD   = "GET";


    /**
     * Language
     */
    const LANGUAGE = "FR";

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

        $parse = $data->filter('body');

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
        $slug = sprintf("%s/%s?type=jour&ot=example.AjaxPageLayout.ot&searchFor=%s",
            self::BASE_URL,
            $this->translateHoroscope($this->horoscope),
            $this->type
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
                return "jour";
                break;
            case "weekly":
                return "semaine";
                break;
            case "monthly":
                return "mois";
                break;
            case "yearly":
                return "annee";
                break;
            default:
                return "jour";
        }
    }

    /**
     * Convert to turkish - english
     *
     * @param $horoscope
     * @return string
     */
    private function translateHoroscope($horoscope)
    {
        switch ($horoscope) {
            case "aries":
                return "Bélier-1.1478041";
                break;
            case "taurus":
                return "Taureau-1.1478042";
                break;
            case "gemini":
                return "Gémeaux-1.1478043";
                break;
            case "cancer":
                return "Cancer-1.1478044";
                break;
            case "leo":
                return "Lion-1.1478045";
                break;
            case "virgo":
                return "Vierge-1.1478046";
                break;
            case "libra":
                return "Balance-1.1478047";
                break;
            case "scorpio":
                return "Scorpion-1.1478048";
                break;
            case "sagittarius":
                return "Sagittaire-1.1478049";
                break;
            case "capricorn":
                return "Capricorne-1.1478050";
                break;
            case "aquarius":
                return "Verseau-1.1478051";
                break;
            case "pisces":
                return "Poisson-1.1478052";
                break;
            default:
                return "Vierge-1.1478046";
                break;
        }
    }
}
