<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * @author Jayesh
     * 
     * @uses Register the exception handling callbacks for the application.
     * 
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        // $this->renderable(function (Throwable $e, $request) {
        //     $page = ($request->segment(1) == 'admin') ? 'admin' : 'user';
        //     if($this->isHttpException($e)) {
        //         switch ($e->getStatusCode()) {
        //             case '404':
        //                 return response()->view($page.'.errors.404', [], 404);
        //                 break;

        //             case '500':
        //                 return response()->view($page.'.errors.500', [], 500);
        //                 break;

        //             default:
        //                 return $this->renderHttpException($e);
        //                 break;
        //         }
        //     } else {
        //         return parent::render($request, $e);
        //     }
        // });
    }
}
