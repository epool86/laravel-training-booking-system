<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
use PDF;

use App\Models\Booking;
use App\Models\Room;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(isset($_GET['search']) || isset($_GET['search2'])){

            $search = $_GET['search'];
            $search2 = $_GET['search2'];

            $bookings = Booking::whereHas('user', function($q) use ($search){
                $q->where('name', 'LIKE', '%'.$search.'%');
            })->whereHas('room', function($q) use ($search2){
                $q->where('name', 'LIKE', '%'.$search2.'%');
            })->get();

        } else {
            $bookings = Booking::all();
            $search = null;
            $search2 = null;
        }

        return view('admin.booking_index', compact('bookings','search','search2'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {

        //0 - pending 
        //1 - approve
        //2 - reject

        if($request['action'] == 'approve'){

            $booking->status = 1;

        } elseif($request['action'] == 'reject'){

            $booking->status = 2;

        }

        $booking->save();
        return redirect()->route('app.admin.booking.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function pdf(){

        $bookings = Booking::all();
        $pdf = PDF::loadView('admin.booking_pdf', compact('bookings'));
        
        return $pdf->download('booking.pdf');

    }
}
