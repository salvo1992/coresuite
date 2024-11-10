<?php

namespace App\Exceptions;

use App\Mail\ExceptionMail;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;
use Twilio\Exceptions\RestException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        RestException::class,
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
     * Report or log an exception.
     *
     * @param \Throwable $exception
     * @return void
     *
     * @throws Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);

        if (env('MAIL_HOST') && env('APP_ENV') == 'production' && $this->shouldReport($exception)) {



            try {
                $this->sendEmail($exception); // sends an email
            } catch (Exception $e) {
                Log::alert('Errore invio email segnalazione errore:' . $e->getMessage());
            }
        }

    }
    public function sendEmail(Throwable $exception)
    {
        try {
            $mailable = new ExceptionMail($exception);
            $mailable->from(env('MAIL_FROM_ADDRESS', 'tuonome@tuodominio.com'), env('MAIL_FROM_NAME', 'Nome Applicazione'));
            
            if (Auth::check()) {
                $mailable->replyTo(Auth::user()->email, Auth::user()->nominativo());
            }
            
            Mail::to('salvatoted1992@gmail.com')->send($mailable);
        } catch (Exception $ex) {
            dd($ex);
        }
    }
}