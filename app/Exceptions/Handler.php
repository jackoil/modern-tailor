<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use throwable;
use Exception;

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
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        //
    }


        /**
     * @param $request
     * @param Throwable $exception

    * @return mixed
    */
    public function render($request, Throwable $exception)
   {
    if($exception instanceof NotFoundHttpException){
        return response()->view('errors/404', ['invalid_url'=>true], 404);
    }

    if ($exception instanceof TokenMismatchException && Auth::guest()) {
        error_log('Error :' . $exception->getMessage());
        abort(500);
    }

    if ($exception instanceof TokenMismatchException && getenv('APP_ENV') != 'local') {
        return redirect()->back()->withInput();
    }

    if($exception instanceof \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException && getenv('APP_ENV') != 'local') {
        error_log('Error :' . $exception->getMessage());
        abort(404);
    }

    if(($exception instanceof PDOException || $exception instanceof QueryException) && getenv('APP_ENV') != 'local') {
        error_log('Error :' . $exception->getMessage());
        abort(500);
    }

    if ($exception instanceof ClientException) {
        error_log('Error :' . $exception->getMessage());
        abort(500);
    }

    return parent::render($request, $exception);
}
}
