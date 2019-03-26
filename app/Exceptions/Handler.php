<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use App\Http\Exceptions\ManualException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Illuminate\Support\Facades\DB;

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
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        DB::rollBack();

        if (!env('APP_DEBUG')) {
            var_dump($exception->getMessage()); die;
            $code = $exception->getCode();

            if ($request->pjax() || $request->wantsJson()) {
                $error = $exception->getMessage();

                $json = array(
                    'code' => $code,
                    'error' => $error,
                    'message' => __("messages.$error")
                );

                return response()->json($json, $code);
            } else {
                if (!$exception instanceof ValidationException && !$exception instanceof UnauthorizedHttpException) {
                    if ($exception instanceof ManualException) {
                        $error = $exception->getMessage();
                    } else {
                        $error = 'SystemError';
                    }

                    $json = array(
                        'code' => $code,
                        'error' => $error,
                        'message' => __("messages.$error")
                    );

                    return response()->json($json, $code);
                }
            }
        } else {
            $code = $exception->getCode();
            $code = !$code ? JsonResponse::HTTP_BAD_REQUEST : $code;

            $json = array(
                'error' => addslashes($exception->getMessage()),
                'trace' => $exception->getTraceAsString()
            );

            return response()->json($json, JsonResponse::HTTP_BAD_REQUEST);
        }

        return parent::render($request, $exception);
    }
}
