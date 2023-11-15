<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Policies\AdminPolicy;
use Illuminate\Auth\Access\AuthorizationException;

class DashboardController extends Controller
{
    /**
     * @throws AuthorizationException
     */
    public function index()
    {
        return view('admin.dashboard');
    }

}
