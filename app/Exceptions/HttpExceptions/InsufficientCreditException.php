<?php

namespace App\Exceptions\HttpExceptions;

use Illuminate\Http\Response;

class InsufficientCreditException extends AbstractHttpException
{
    /**
     * NotCreditException constructor.
     *
     * @param int $code
     * @param string|null $message
     */
    public function __construct($code = Response::HTTP_UNPROCESSABLE_ENTITY, string $message = 'The client credit is not enough.')
    {
        parent::__construct($code, $message);
    }
}
