<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Middleware\BaseMiddleware;


abstract class BaseController extends AbstractController
{


    /**
     * @return string[]
     */
    abstract protected function getMiddlewares();


    /**
     * @param Request $request
     * @return Response
     */
    abstract public function handle(Request $request): Response;


    /**
     * @param Request $request
     * @return Response
     */
    public final function onRequest(Request $request): Response
    {
        $middlewares = $this->getMiddlewares();
        $first = $middlewares[0];
        $other = array_slice($middlewares, 1);
        /** @var BaseMiddleware */
        $firstHandler = new $first(array_merge($other, [$this::class, ]));
        return $firstHandler->handle($request);
    }


}
