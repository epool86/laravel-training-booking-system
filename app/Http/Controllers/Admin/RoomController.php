<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Room;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = Room::all();
        return view('admin.room_index', compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $room = new Room;
        return view('admin.room_form', compact('room'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'capacity' => 'nullable|integer',
            'facility' => 'nullable|array',
            'photo' => 'nullable|mimes:jpeg,jpg,png|max:10000', //10mb max
            'status' => 'required|in:0,1',
        ]);

        $room = new Room;
        $room->fill($request->all());
        $room->facility = $request['facility'] ? json_encode($request['facility']) : json_encode([]);
        $room->save();

        //save photo
        if($request['photo']){

            $directory = $_SERVER['DOCUMENT_ROOT']."uploads/rooms";
            if(!file_exists($directory)){
                mkdir($directory, 0755, true);
            }

            $filename = "room_".$room->id.".".$request->photo->getClientOriginalExtension();
            $file = $request->file('photo');
            $file->move($directory, $filename);

            $room->photo = $filename;
            $room->save();

        }

        return redirect()->route('app.admin.room.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
        return view('admin.room_form', compact('room'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $room)
    {
        $this->validate($request, [
            'name' => 'required',
            'capacity' => 'nullable|integer',
            'facility' => 'nullable|array',
            'photo' => 'nullable|mimes:jpeg,jpg,png|max:10000', //10mb max
            'status' => 'required|in:0,1',
        ]);

        $room->fill($request->all());
        $room->facility = $request['facility'] ? json_encode($request['facility']) : json_encode([]);
        $room->save();

        //save photo
        if($request['photo']){

            $directory = $_SERVER['DOCUMENT_ROOT']."uploads/rooms";
            if(!file_exists($directory)){
                mkdir($directory, 0755, true);
            }

            $filename = "room_".$room->id."_".time().".".$request->photo->getClientOriginalExtension();
            $file = $request->file('photo');
            $file->move($directory, $filename);

            $room->photo = $filename;
            $room->save();

        }

        return redirect()->route('app.admin.room.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        $room->delete();
        return redirect()->route('app.admin.room.index');
    }
}
