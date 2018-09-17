<?php

namespace ismailcaakir\Astrology;

use ismailcaakir\Astrology\Exceptions\NotFoundResourceException;
use ismailcaakir\Astrology\Exceptions\NotSupportedHoroscopeException;
use ismailcaakir\Astrology\Exceptions\NotSupportedLanguageException;
use ismailcaakir\Astrology\Exceptions\InvalidDateException;
use ismailcaakir\Astrology\Helpers\Functions;

class Astrology
{


    /**
     * @var Functions
     */
    private $helper;

    /**
     * @var array
     */
    public $response;

    /**
     *
     */
    const __RESOURCE_NAMESPACE__ = "ismailcaakir\Astrology\Resources";

    /**
     * Astrology constructor.
     */
    public function __construct()
    {

        $this->helper = new Functions();
    }

    /**
     * @param null $horoscope
     * @param string $resources
     * @param null $type
     * @param string $language
     * @return Astrology
     * @throws NotFoundResourceException
     * @throws NotSupportedHoroscopeException
     * @throws NotSupportedLanguageException
     */
    public function dailyFetch($horoscope = null, $resources = "resource_1", $type = null, $language = "TR")
    {
        if (!in_array(strtolower($horoscope),Config::getSupportedHoroscopes($language)))
        {
            throw new NotSupportedHoroscopeException('Burca ait bilgiler bulunamadı. Böyle bir burç yok yada desteklenmiyor.');
        }

        if (!array_key_exists($resources,Config::getSupportedResources($language)))
        {
            throw new NotFoundResourceException('Belirsiz kaynak lütfen geçerli bir kaynak kullanın.');
        }

        if (isset($language) && !in_array(strtoupper($language), Config::getSupportedLanguages($language)))
        {
            throw new NotSupportedLanguageException("Bu dil desteklenmiyor.");
        }

        /*if (isset($date) && !$this->helper->validateDate($date))
        {
            throw new InvalidDateException("Geçersiz tarih formatı.");
        }*/

        $resource = Config::getSupportedResources($language)[$resources];

        $className = self::__RESOURCE_NAMESPACE__."\\".$language."\\".$resource["model"];

        $s = new $className($horoscope, $type, $language);

        $this->response = $s->getResponse();

        return $this;
    }

    /**
     * @return object
     */
    public function getResponse()
    {
        return (object) $this->response;
    }


}
