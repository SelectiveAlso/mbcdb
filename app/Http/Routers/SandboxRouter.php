<?php

namespace App\Http\Routers;

use Route; // Route facade (Illuminate\Support\Facades\Route)

class SandboxRouter implements RouterInterface {
    public static function setRoutes() {
      Route::get('/search', 'SandboxController@search');
    }
}