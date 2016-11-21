<?php
use Illuminate\Support\Facades\Auth;

Route::group(['middleware' => 'web', 'prefix' => 'admin', 'namespace' => 'Modules\Admin\Http\Controllers'], function () {
    Route::get('/{route?}', 'AdminController@layout')->where('route', '.*');
});
Route::group(['middleware' => 'auth:api', 'prefix' => 'admin/api'], function () {
    Route::get('users/me', function() {
        return Auth::user();
    });
    Route::resource('project', 'Modules\Admin\Http\Controllers\Api\ProjectController');
});
