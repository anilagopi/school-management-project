<?php

namespace App\Enums;

/**
 * Class EnumValidation contains list of validation messages.
 *
 * @package App\Enums
 */
class EnumValidation
{
    const REQUIRED      = 'required';
    const DATE          = 'date';
    const URL           = 'url';
    const MAX           = 'max';
    const INTEGER       = 'integer';
    const ALPHA_NUMERIC = 'alpha_num';
    const REGEX         = 'regex';
    const REGEX_NUMERIC = 'regex:/^(\#[\da-fA-F]{3}|\#[\da-fA-F]{6})$/';
    const ARRAY_MIN     = 'required|array|min:1';
}
