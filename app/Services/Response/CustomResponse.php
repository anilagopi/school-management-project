<?php

namespace App\Services\Response;

use App\Enums\Response\EnumStatusCode;

class CustomResponse
{
    /**
     * @var EnumStatusCode The response status.
     */
    public $status;

    /**
     * @var string The response message.
     */
    public $message;

    /**
     * @var mixed The response data.
     */
    public $data;
    /**
     * @var mixed The response data.
     */
    public $type;
    /**
     * @var string
     */
    public $filename;
    /**
     * @var string
     */
    public $filenameSize;

    public function buildResponse($status, $type, $message)
    {
        $this->status    = $status;
        $this->type      = $type;
        $this->message[] = $message;

        return $this;
    }

}
