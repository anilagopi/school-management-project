<?php

namespace App\Services\Validation;


use Illuminate\Http\Request;
use Validator;

class ValidationService
{
    /**
     * Validates data.
     *
     * @param mixed $request Contains data to be validated.
     * @param array   $rules   List of rules to be validated.
     * @param array   $messages List of custom error messages.
     *
     * @return bool|\Illuminate\Contracts\Validation\Validator Return errors object if fail, return true if pass.
     */
    public static function validate($request, array $rules, array $messages = [])
    {
        $data = $request instanceof Request ? $request->all() : $request;
        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails())
        {
            return $validator;
        }

        return true;
    }
}
