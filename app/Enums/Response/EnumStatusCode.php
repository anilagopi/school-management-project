<?php

namespace App\Enums\Response;

/**
 * Class StatusCode contains list of Http status code.
 *
 * @package App\Enums\Response
 */
class EnumStatusCode
{
    const UNKNOWN     = 'UNKNOWN';
    const SUCCESS     = 'SUCCESS';
    const ERROR       = 'ERROR';
    const INFO        = 'INFO';
    const NO_DATA     = 'no_data';
    const ERROR_404   = '404';
    const ERROR_500   = 500;
    const ERROR_403   = 403;
    const SUCCESS_200 = 200;
    const ERROR_204   = 204;
}
