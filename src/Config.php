<?php

namespace ismailcaakir\Astrology;

class Config
{

    /**
     * Paketin Desteklediği Kaynaklar
     * @var array
     */
    protected static $resources = [

        "TR" => [

            "resource_1" => [
                "model" => "Mynet",
                "url" => "https://www.mynet.com/kadin/burclar-astroloji/"
            ],

            "resource_2" => [
                "model" => "BurcunNet",
                "url" => "http://burcun.net"
            ],
        ],

        "EN" => [

        ]
    ];

    /**
     * Paketin Desteklediği Diller
     * @var array
     */
    protected static $languages = [
        "TR", "EN"
    ];

    /**
     * Paketin Desteklediği Dilleri Döndürür
     *
     * @param string $language
     * @return array
     */
    public static function getSupportedLanguages($language = "TR")
    {
        return self::$languages;
    }

    /**
     * Paketin Desteklediği Kaynakları Döndürür.
     *
     * @param string $language
     * @return mixed
     */
    public static function getSupportedResources($language = "TR")
    {
        return self::$resources[$language];
    }

    /**
     * Paketin Desteklediği Burçları Döndürür.
     *
     * @param string $language
     * @return array
     */
    public static function getSupportedHoroscopes($language = "TR")
    {
        return ["koc", "boga", "ikizler", "yengec", "aslan", "basak", "terazi", "akrep", "yay", "oglak", "kova", "balik"];
    }

}
