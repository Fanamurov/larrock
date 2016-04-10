<?php
namespace App\Exceptions;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Validation\ValidationException;
use GrahamCampbell\Exceptions\ExceptionHandler;
class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];
    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        return parent::report($e);
    }
    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        /* http://www.techigniter.in/tutorials/create-custom-error-pages-in-laravel-5/ */
        if(config('app.debug') === false){
            /* PRODUCTION */
            if($this->isHttpException($e))
            {
                switch ($e->getStatusCode()) {
                    // not found
                    case 404:
                        return \Response::view('errors.404',array(),404);
                        break;
                    // internal error
                    case '500':
                        return \Response::view('errors.500',array(),500);
                        break;
                    default:
                        return $this->renderHttpException($e);
                        break;
                }
            }
        }
        return parent::render($request, $e);
    }
}