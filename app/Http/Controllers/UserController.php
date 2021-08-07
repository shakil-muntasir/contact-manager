<?php

namespace App\Http\Controllers;

use App\Http\Resources\User as UserResource;

class UserController extends Controller
{
    public function show()
    {
        return new UserResource(request()->user());
    }
}
