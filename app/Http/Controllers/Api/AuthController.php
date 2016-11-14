<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\JWTAuth;
use Laravel\Lumen\Routing\Controller;

class AuthController extends Controller
{
    /**
     * @var \Tymon\JWTAuth\JWTAuth
     */
    protected $jwt;

    public function __construct(JWTAuth $jwt)
    {
        $this->jwt = $jwt;
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required',
        ]);
        try {
            if (!$token = $this->jwt->attempt($request->only('email', 'password'))) {
                return response()->json(['error' => 'user_not_found'], 404);
            }
        } catch (TokenExpiredException $e) {
            return response()->json(['error' => 'token_expired'], 500);
        } catch (TokenInvalidException $e) {
            return response()->json(['error' => 'token_invalid'], 400);
        } catch (JWTException $e) {
            return response()->json(['error' => 'token_absent', 'message' => $e->getMessage()], 500);
        }

        return response()->json(compact('token'));
    }

    public function refreshToken(Request $request)
    {
        $this->validate($request, ['token' => 'required']);
        try {
            $this->jwt->setToken($request->get('token'));
            $token = $this->jwt->refresh();
        } catch (TokenInvalidException $e) {
            return response()->json(['error' => 'token_invalid'], 400);
        }
        return response()->json(compact('token'));
    }
}
