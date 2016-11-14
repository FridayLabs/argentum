<?php

namespace App\Http\Middleware;

use Illuminate\Contracts\Auth\Factory as Auth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\JWTGuard;

class Authenticate
{
    /**
     * The authentication guard factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param \Illuminate\Contracts\Auth\Factory $auth
     *
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     * @param string|null              $guard
     *
     * @return mixed
     */
    public function handle($request, \Closure $next, $guard = null)
    {
        /**
         * @var $guard JWTGuard
         */
        $guard = $this->auth->guard($guard);
        try {
            $guard->getPayload();
        } catch (TokenExpiredException $e) {
            return response()->json(['error' => 'token_expired'], 401);
        }

        if ($guard->guest()) {
            return response('Unauthorized.', 401);
        }

        return $next($request);
    }
}
