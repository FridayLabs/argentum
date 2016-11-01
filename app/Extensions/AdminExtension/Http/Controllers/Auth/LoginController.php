<?php

namespace App\Extensions\AdminExtension\Http\Controllers\Auth;

use App\Extensions\AdminExtension\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('admin::layout');
    }
}
