<?php

namespace Carbon\Middleware;
use Carbon\Models\User;

class APIMiddleware extends Middleware {
    public function __invoke($request, $response, $next) {
        $key = $request->getParam('key');
        if (!User::where('exchange_code', $key)->first()) {
            return $response->withStatus(401);
        } else {
            return $next($request, $response);
        }
    }
}

?>
