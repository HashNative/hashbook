<?php

namespace App\Http\Controllers;

use Dingo\Api\Exception\ResourceException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiController extends Controller
{
    /**
     * Create the response for when a request fails validation.
     *
     * @param Request $request
     * @param  array $errors
     * @return Response
     */
    protected function buildFailedValidationResponse(Request $request, array $errors)
    {
        if ($request->expectsJson()) {
            throw new ResourceException('Validation Error', $errors);
        }

        return redirect()->to($this->getRedirectUrl())->withInput($request->input())->withErrors($errors, $this->errorBag());
    }
}
