<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class DashboardController extends Controller
{
    public function dashboard(){

        if(Auth::user()->role == 'admin'){
            return redirect()->route('app.admin.dashboard');
        }
        return view('user.dashboard');

    }
}
