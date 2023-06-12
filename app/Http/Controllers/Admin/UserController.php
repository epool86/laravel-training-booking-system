<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(isset($_GET['search'])){
            $users = User::where('name', 'LIKE', '%'.$_GET['search'].'%')->paginate(5);
            $search = $_GET['search'];
        } else {
            $users = User::paginate(5);
            $search = null;
        }

        return view('admin.user_index', compact('users','search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User;
        return view('admin.user_form', compact('user'));
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
            'staff_id' => 'nullable|min:5',
            'email' => 'required|email|unique:users,email',
            'department' => 'nullable',
            'role' => 'required|in:user,admin',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = new User;

        $user->fill($request->except('password'));
        $user->role = $request['role'];
        $user->password = Hash::make($request['password']);

        //$user->name = $request['name'];
        //$user->email = $request['email'];
        //$user->department = $request['department'];

        $user->save();

        return redirect()->route('app.admin.user.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.user_form', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => 'required',
            'staff_id' => 'nullable|min:5',
            'email' => 'required|email|unique:users,email',
            'department' => 'nullable',
            'role' => 'required|in:user,admin',
            'password' => 'nullable|min:8|confirmed',
        ]);

        $user->fill($request->except('password'));
        $user->role = $request['role'];
        if($request['password']){
            $user->password = Hash::make($request['password']);
        }
        $user->save();

        return redirect()->route('app.admin.user.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('app.admin.user.index');
    }
}
