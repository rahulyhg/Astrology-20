<?php

namespace ismailcaakir\Astrology;

use Carbon\Carbon;
use ismailcaakir\Astrology\Exceptions\NotFoundResourceException;
use ismailcaakir\Astrology\Exceptions\NotSupportedHoroscopeException;
use ismailcaakir\Astrology\Exceptions\NotSupportedLanguageException;
use ismailcaakir\Astrology\Exceptions\InvalidDateException;
use ismailcaakir\Astrology\Helpers\Functions;
use ismailcaakir\Astrology\Resources\TR\BurcunNet;

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
     * @param null $date
     * @param string $language
     * @return Astrology
     * @throws InvalidDateException|NotSupportedHoroscopeException|NotSupportedLanguageException|NotFoundResourceException
     */
    public function dailyFetch($horoscope = null, $resources = "resource_1", $date = null, $language = "TR")
    {
        if (!in_array(strtolower($horoscope),config('astrology.supported_horoscopes')))
        {
            throw new NotSupportedHoroscopeException('Burca ait bilgiler bulunamadı. Böyle bir burç yok yada desteklenmiyor.');
        }

        if (!array_key_exists($resources,config("astrology.resources.{$language}")))
        {
            throw new NotFoundResourceException('Belirsiz kaynak lütfen geçerli bir kaynak kullanın.');
        }

        if (isset($language) && !in_array(strtoupper($language), config('astrology.supported_languages')))
        {
            throw new NotSupportedLanguageException("Bu dil desteklenmiyor.");
        }

        if (isset($date) && !$this->helper->validateDate($date))
        {
            throw new InvalidDateException("Geçersiz tarih formatı.");
        }

        $resource = config("astrology.resources.{$language}.{$resources}");

        $className = self::__RESOURCE_NAMESPACE__."\\".$language."\\".$resource["model"];

        $s = new $className($horoscope, $date, $language);

        $this->response = $s->getResponse();

        return $this;
    }

    /**
     * @return array
     */
    public function getResponse(): array
    {
        return $this->response;
    }


}
