<?php

namespace App\Exceptions;

use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use Throwable;
use Illuminate\Http\Request;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
//            return ($e->getCode()==23000);

            if($e->getCode()==23000){
                Log::channel('sql')->warning($e->getMessage());
                return false;
            }
            return true;
        });

        $this->renderable(function (QueryException $e, Request $request) {
            if($e->getMessage() == 23000){
                $message='Foreign Key Constrain Failed';
            }else{
                $message=$e->getMessage();
            }

            //if Api
            if($request->expectsJson()){
                return response()->json([
                    'message'=>$message,
                ],400);
            }
            return redirect()
                ->back()->withInput()
                ->withErrors([
                    'message'=>$message
                ])->with('info',$message);
        });
    }
}
