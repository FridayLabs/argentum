<?php

namespace App\Http\Controllers\Api;

use Laravel\Lumen\Routing\Controller;

class ProjectController extends Controller
{
    public function list()
    {
        $user = \Tymon\JWTAuth\Facades\JWTAuth::parseToken()->authenticate();

        dd($user);
    }

}
