<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Room;
use App\Models\Booking;

class DashboardController extends Controller
{
    public function dashboard(){

        $rooms = Room::all();

        $total_booking = Booking::count();
        $total_pending = Booking::where('status', 0)->count();
        $total_approve = Booking::where('status', 1)->count();
        $total_reject = Booking::where('status', 2)->count();

        return view('admin.dashboard', compact('rooms','total_booking','total_pending','total_approve','total_reject'));

    }
}
