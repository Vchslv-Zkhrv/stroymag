<?php


namespace App\Middleware;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


abstract class BaseMiddleware
{


    /** @var callable[] */
    private readonly array $next;


    /**
     * @param callable[] $next
     */
    public final function __construct($next)
    {
        $this->next = $next;
    }


    protected final function lauchNext(Request $request): Response
    {
        $handlerClass = $this->next[0];
        $left = array_slice($this->next, 1);
        $handler = $left ? new $handlerClass($left) : new $handlerClass();
        /** @var Response */
        return $handler->handle($request);
    }


    abstract public function handle(Request $request): Response;


}
