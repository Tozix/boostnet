<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function Permission(Request $request)
    {
        $user = $request->user();
        dd($user->hasRole('admin')); //will return true, if user has role

    }
}
