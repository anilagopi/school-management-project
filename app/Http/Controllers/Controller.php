<?php

namespace App\Http\Controllers;

use App\Enums\EnumGeneral;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function __construct()
    {

        /**
         * Any platform wide functions go in here
         * Loading the auth module by default
         */

        $this->middleware('auth');
    }

    /**
     * This is used to set notification array.
     *
     * @param string $message
     * @param string $alertType
     *
     * @return array
     */
    public function setNotificationMessage(string $message, string $alertType): array
    {
        return [
            'message'    => $message,
            'alert-type' => $alertType,
        ];
    }
}
