<?php

namespace Argentum\Http\Controllers\Api;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\JWTAuth;

class AuthController extends Controller
{
    use ValidatesRequests;

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

        $this->updateUserToken($token);
        return response()->json(compact('token'));
    }

    public function refreshToken(Request $request)
    {
        $this->validate($request, ['token' => 'required']);
        try {
            $this->jwt->setToken($request->get('token'));
            $token = $this->jwt->refresh();

            $this->updateUserToken($token);
        } catch (TokenInvalidException $e) {
            return response()->json(['error' => 'token_invalid'], 400);
        }
        return response()->json(compact('token'));
    }

    protected function updateUserToken($token)
    {
        $user = Auth::user();
        $user->api_token = $token;
        $user->save();
    }
}
