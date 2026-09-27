<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function superAdmin()
    {
        return view('dashboards.super-admin');
    }

    public function admin()
    {
        return view('dashboards.admin');
    }

    public function user()
    {
        return view('dashboards.user');
    }

    public function subUser()
    {
        return view('dashboards.sub-user');
    }
}