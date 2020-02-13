<?php

namespace Illuminate\Validation;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class ValidationException extends Exception
{
    /**
     * The validator instance.
     *
     * @var \Illuminate\Contracts\Validation\Validator
     */
    public $validator;

    /**
     * The recommended response to send to the client.
     *
     * @var Response|null
     */
    public $response;

    /**
     * Create a new exception instance.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @param  Response  $response
     * @return void
     */
    public function __construct($validator, $response = null)
    {
        parent::__construct('The given data failed to pass validation.');

        $this->response = $response;
        $this->validator = $validator;
    }

    /**
     * Get the underlying response instance.
     *
     * @return Response|null
     */
    public function getResponse()
    {
        return $this->response;
    }
}
