<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;

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

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
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

        });
    }

    public function render($request, Throwable $e)
    {
        if ($e instanceof  UnauthorizedHttpException){
            dd(false);
        }
        switch (class_basename($e)) {
            case 'NotFoundHttpException':
                if ($request->expectsJson()) {
                    return response()->json([
                        'message' => 'We could not locate the data you requested, it may have been lost forever'
                    ], 404);
                }
                break;
            case 'MethodNotAllowedHttpException':
                if ($request->expectsJson()) {
                    return response()->json(
                        ['errors' => ['forms' => 'Method Not Allowed']
                        ], 405);
                }
                break;
            default:
                if ($request->expectsJson()) {
                    return response()->json(['errors' => ['forms' => 'Yêu cầu không hợp lệ hoặc chưa đăng nhập']], 401);
                }
                break;
        }
        return parent::render($request, $e);
    }

}

