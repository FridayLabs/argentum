<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class AdminController extends BaseController
{
    public function layout()
    {
        return view('admin.layout');
    }
}
