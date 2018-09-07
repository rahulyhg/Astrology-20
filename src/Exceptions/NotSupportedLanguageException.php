<?php
/**
 * Created by PhpStorm.
 * User: stablemobile09
 * Date: 7.09.2018
 * Time: 09:12
 */

namespace ismailcaakir\Astrology\Exceptions;

use Throwable;

class NotSupportedLanguageException extends \Exception
{


    /**
     * NotSupportedLanguageException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}
