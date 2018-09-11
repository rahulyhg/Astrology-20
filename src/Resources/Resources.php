<?php
/**
 * Created by PhpStorm.
 * User: stablemobile09
 * Date: 7.09.2018
 * Time: 13:37
 */

namespace ismailcaakir\Astrology\Resources;


use ismailcaakir\Astrology\Helpers\Functions;

class Resources
{
    /**
     * @var \Goutte\Client
     */
    protected $goutteClient;

    /**
     * @var \GuzzleHttp\Client
     */
    protected $guzzleClient;

    /**
     * @var Functions
     */
    protected $helper;

    /**
     * Resources constructor.
     */
    public function init()
    {
        //
        $this->goutteClient = new \Goutte\Client();

        //
        $this->guzzleClient = new \GuzzleHttp\Client();

        //
        $this->goutteClient->setClient($this->guzzleClient);

        //
        $this->helper   = new Functions();
    }

    /**
     * @param array $invalidWords
     * @param string $nodeValue
     * @return bool
     */
    public function deleteAllLineIfInvalidWords($invalidWords = [], $nodeValue = "")
    {
        foreach ($invalidWords as $word)
        {
            if (strpos($nodeValue, $word))
            {
                return true;
            }
        }

        return false;
    }

}
