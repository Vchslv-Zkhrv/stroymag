<?php


namespace App\Middleware;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Cookie;
use UUID\UUID;


class IdentityMiddleware extends BaseMiddleware
{


    public function handle(Request $request): Response
    {

        // pre-actions
        if ($request->cookies->has('identity')) {
            $request->attributes->set('identity', $request->cookies->get('identity'));
        }
        else {
            $request->attributes->set('identity', UUID::uuid6());
        }

        // execution
        $response = $this->lauchNext($request);

        // post-actions
        $response->headers->setCookie(
            new Cookie('identity', $request->attributes->get('identity'), "+365 days")
        );

        return $response;

    }


}
