<?php

namespace App\Exceptions;

use App\Common\Responses\APIResponse;
use App\Exceptions\HttpExceptions\AbstractHttpException as HTTPException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response as HTTPResponse;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException as SymfonyHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    protected $appExceptions = [
        NotFoundHttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
        HttpResponseException::class,
        MethodNotAllowedHttpException::class,
        SymfonyHttpException::class,
        ThrottleRequestsException::class,
        BadRequestHttpException::class,
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = ['password', 'password_confirmation'];

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param Throwable $exception
     *
     * @return HTTPResponse
     *
     * @throws Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof HTTPException) {
            return $this->generateJsonResponseForHttpExceptions($exception);
        }
        if (in_array(get_class($exception), $this->appExceptions)) {
            return $this->generateJsonResponseForAppExceptions($exception);
        }
        return parent::render($request, $exception);
    }

    /**
     * @param HTTPException $e
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function generateJsonResponseForHttpExceptions(HTTPException $e)
    {
        return APIResponse::error($e->getError(), $e->getMessage(), $e->getCode(), [], $e->getExtraInfo());
    }

    /**
     * @param \Throwable $e
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function generateJsonResponseForAppExceptions(\Throwable $e)
    {
        $class = get_class($e);

        switch ($class) {
            case NotFoundHttpException::class:
            case ModelNotFoundException::class:
                $statusCode = HTTPResponse::HTTP_NOT_FOUND;
                $msg        = $e->getMessage();
                break;
            case ValidationException::class:
                $statusCode = HTTPResponse::HTTP_UNPROCESSABLE_ENTITY;
                $msg        = $e->validator->errors()->getMessages();
                break;
            case HttpResponseException::class:
                $statusCode = HTTPResponse::HTTP_INTERNAL_SERVER_ERROR;
                $msg        = $e->getMessage();
                break;
            case MethodNotAllowedHttpException::class:
                $statusCode = HTTPResponse::HTTP_METHOD_NOT_ALLOWED;
                $msg        = $e->getMessage();
                break;
            case ThrottleRequestsException::class:
                $statusCode = HTTPResponse::HTTP_TOO_MANY_REQUESTS;
                $msg        = $e->getMessage();
                break;
            case BadRequestHttpException::class:
                $statusCode = HTTPResponse::HTTP_BAD_REQUEST;
                $msg        = $e->getMessage();
                break;
            default:
                $statusCode = HTTPResponse::HTTP_INTERNAL_SERVER_ERROR;
                $msg        = 'Error';
        }

        return APIResponse::error($statusCode, $msg, $statusCode);
    }
}
