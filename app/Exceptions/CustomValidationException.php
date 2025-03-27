<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class CustomValidationException extends ValidationException
{
    public function render($request)
    {
        if (!$request->wantsJson()) {
            return redirect()->back()->withErrors($this->validator->errors());
        }

        return new JsonResponse([
            'success' => false,
            'message' => 'Validation Error Occurs, Check Error',
            'status_code' => Response::HTTP_UNPROCESSABLE_ENTITY,
            'errors' => $this->validator->errors()->getMessages(),
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
