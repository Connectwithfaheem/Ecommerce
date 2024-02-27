<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     *   * @param \Illuminate\Http\Request $request
    * @param \Throwable $exception
    * @return \Symfony\Component\HttpFoundation\Response
    *
    * @throws \Throwable
    */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

   public function render($request, Throwable $exception)
   {
       if ($request->expectsJson()) {
           return response()->json(['error' => $exception->getMessage()], 500);
       }

       return parent::render($request, $exception);
   }

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
