<?php

namespace ismailcaakir\Astrology;

class Config
{

    /**
     * Paketin Desteklediği Kaynaklar
     * @var array
     */
    protected static $resources = [

        'TR' => [
            'resource_1' => [
                'model' => 'Hurriyet',
                'url' => 'https://www.mynet.com/kadin/burclar-astroloji/'
            ]
        ],

        'EN' => [
            'resource_1' => [
                'model' => 'HoroscopeApiCom',
                'url'   => 'http://horoscope-api.herokuapp.com/horoscope/today'
            ],

        ],

        'FR' => [
            'resource_1' => [
                'model' => 'Sympatico',
                'url'   => 'http://www.sympatico.ca/horoscope/traditionnel'
            ],

        ]
    ];

    /**
     * Paketin Desteklediği Diller
     * @var array
     */
    protected static $languages = [
        'TR', 'EN', 'FR'
    ];

    /**
     * Paketin Desteklediği Dilleri Döndürür
     *
     * @param string $language
     * @return array
     */
    public static function getSupportedLanguages($language = 'TR')
    {
        return self::$languages;
    }

    /**
     * Paketin Desteklediği Kaynakları Döndürür.
     *
     * @param string $language
     * @return mixed
     */
    public static function getSupportedResources($language = 'TR')
    {
        return self::$resources[$language];
    }

    /**
     * Paketin Desteklediği Burçları Döndürür.
     *
     * @param string $language
     * @return array
     */
    public static function getSupportedHoroscopes($language = 'TR')
    {
        return ['aries', 'taurus', 'gemini', 'cancer', 'leo', 'virgo', 'libra', 'scorpio', 'sagittarius', 'capricorn', 'aquarius', 'pisces'];
    }

}
