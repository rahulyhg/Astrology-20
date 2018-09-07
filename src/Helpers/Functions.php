<?php
/**
 * Created by PhpStorm.
 * User: stablemobile09
 * Date: 7.09.2018
 * Time: 09:28
 */

namespace ismailcaakir\Astrology\Helpers;


use DateTime;

class Functions
{

    /**
     * Date Validation
     *
     * @param $date
     * @param string $format
     * @return bool
     */
    public function validateDate($date, $format = 'Y/m/d')
    {
        $d = DateTime::createFromFormat($format, $date);

        return $d && $d->format($format) == $date;
    }


    /**
     *
     *
     * @param $string
     * @return string
     */
    public function replaceWithStartZero($string)
    {
        if (starts_with($string,"0"))
        {
            $string = str_replace_first('0','',$string);
        }

        return $string;
    }

    /**
     * @param string $nodeValue
     * @return mixed
     */
    public function clearHtml(string $nodeValue)
    {
        $string = str_replace('(adsbygoogle = window.adsbygoogle || []).push({});', '', $nodeValue);

        $string = str_replace('\\n', '', $string);

        return $string;
    }
}
