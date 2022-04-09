<?php

namespace App\Exceptions;

use App\Traits\ApiResponse\ApiResponse;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;
use TypeError;

class Handler extends ExceptionHandler
{
    use ApiResponse;

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * @param $request
     * @param Throwable $e
     * @return Response|JsonResponse|HttpFoundationResponse
     */
    public function render($request, Throwable $e): Response|JsonResponse|HttpFoundationResponse
    {
        return $this->handleException($request, $e);
    }

    /**
     * @param $request
     * @param Throwable $e
     * @return JsonResponse
     */
    private function handleException($request, Throwable $e): JsonResponse
    {
        if ($e instanceof ValidationException) {
            return $this->errorResponse($e->validator->errors()->getMessages(), 422);
        }

        if ($e instanceof ModelNotFoundException) {
            $modelName = strtolower(class_basename($e->getModel()));
            return $this->errorResponse("Does not exist any {$modelName} with the specified identifier.", 404);
        }

        if ($e instanceof AuthenticationException) {
            return $this->errorResponse('Bad Credentials', 401);
        }

        if ($e instanceof AuthorizationException) {
            return $this->errorResponse($e->getMessage(), 403);
        }

        if ($e instanceof UnauthorizedException) {
            return $this->errorResponse("You don't have permissions to access this endpoint or resource on this server.", 403);
        }

        if ($e instanceof MethodNotAllowedHttpException) {
            return $this->errorResponse($e->getMessage(), 405);
        }

        if ($e instanceof NotFoundHttpException) {
            return $this->errorResponse('The specified URL can not be found.', 404);
        }

        if ($e instanceof HttpException) {
            return $this->errorResponse($e->getMessage(), $e->getStatusCode());
        }

        if ($e instanceof QueryException) {
            $errorCode = $e->errorInfo[1];

            if ($errorCode === 1451)
                return $this->errorResponse("Can not remove this resource permanently. It is related with any other resource.",
                    409);
            elseif ($errorCode === 1452)
                return $this->errorResponse('Can not add this resource. It is related with any other resource.
                Check if the resource which is related exists.', 409);
            elseif ($errorCode === 1146)
                return $this->errorResponse($e->errorInfo[2], 422);
        }

        if ($e instanceof TypeError) {
            return $this->errorResponse($e->getMessage(), 422);
        }

        return $this->errorResponse($e->getMessage(), 500);
        // return $this->errorResponse('Unexpected Exception. Try later.', 500);
    }
}
