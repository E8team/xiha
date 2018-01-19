<?php

namespace App\Exceptions;

use App\Exceptions\Contract\MessageBagErrors;
use App\Exceptions\Debug\WantsJsonRequest;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Lang;

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

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        //
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if (config('app.debug')) {
            $request = new WantsJsonRequest($request);
        }
        return parent::render($request, $exception);
    }

    /**
     * Convert a validation exception into a JSON response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Illuminate\Validation\ValidationException $exception
     * @return \Illuminate\Http\JsonResponse
     */
    protected function invalidJson($request, ValidationException $exception)
    {
        return response()->json($this->errorFormat(new ResourceException(null, $exception->errors())), $exception->status);
    }

    /**
     * Convert the given exception to an array.
     *
     * @param  \Exception $e
     * @return array
     */
    protected function convertExceptionToArray(Exception $e)
    {
        return $this->errorFormat($e);
    }

    protected function errorFormat(Exception $e)
    {
        $errorFormat = config('api.errorFormat');
        $statusCode = $this->getStatusCode($e);

        if (!$message = $e->getMessage()) {
            $message = sprintf('%d %s', $statusCode, isset(Response::$statusTexts[$statusCode]) ? Response::$statusTexts[$statusCode] : 'Unknown status code');
        }

        $replacements = [
            ':message' => $message,
            ':status_code' => $statusCode,
        ];

        if ($e instanceof MessageBagErrors && $e->hasErrors()) {
            $replacements[':errors'] = $e->getErrors();
        }

        if ($code = $e->getCode()) {
            $replacements[':code'] = $code;
        }
        if (config('app.debug')) {
            $replacements[':debug'] = [
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'class' => get_class($e),
                'trace' => explode("\n", $e->getTraceAsString()),
            ];
        }
        array_walk_recursive($errorFormat, function (&$value, $key) use ($e, $replacements) {
            if (starts_with($value, ':') && isset($replacements[$value])) {
                $value = $replacements[$value];
            }
        });
        return $this->recursivelyRemoveEmptyReplacements($errorFormat);
    }

    /**
     * Recursirvely remove any empty replacement values in the response array.
     *
     * @param array $input
     *
     * @return array
     */
    protected function recursivelyRemoveEmptyReplacements(array $input)
    {
        foreach ($input as &$value) {
            if (is_array($value)) {
                $value = $this->recursivelyRemoveEmptyReplacements($value);
            }
        }

        return array_filter($input, function ($value) {
            if (is_string($value)) {
                return !starts_with($value, ':');
            }

            return true;
        });
    }

    /**
     * Get the status code from the exception.
     *
     * @param \Exception $exception
     *
     * @return int
     */
    protected function getStatusCode(Exception $exception)
    {
        return $this->isHttpException($exception) ? $exception->getStatusCode() : 500;
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Illuminate\Auth\AuthenticationException $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            $e = new HttpException(401, Lang::get('auth.please_login_first'), null, [], 401);
            return response()->json($this->errorFormat($e), $e->getStatusCode());
        }
        return redirect()->guest('login');
    }

}
