<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
        public function index(User $user)
    {
        $this->authorize('viewAny',$user);
        $users = User::all();
        $roles = Role::all();
        return view('users.index')->with('users',$users)->with('roles',$roles);
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
        $request->validate([
            'name' => 'string|required|max:50',
            'email' => 'string|required|max:50|unique:users,email',
            'role' => 'string|required',

        ]);
        // $name = $request->input('name');

        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->role_id = $request->input('role');
        if($request->input('role')==1){
	        $user->password = Hash::make('admin1234');
        } else {
	        $user->password = Hash::make('12345678');
        }
        $user->save();
        return redirect( route('users.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
        return view('users.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if($request->input('password')){
            if($request->input('password')==$request->input('cpassword')){
                $user->password = Hash::make($request->input('password'));
                $user->save();
                return redirect('home');
            }
        } else {
            if($user->role_id != 1){
                if($user->name != $request->input('name')){
                    $request->validate([
                    'name' => 'string|required|max:50'
                    ]);
                }
                if($user->email != $request->input('email')){
                    $request->validate([
                    'email' => 'string|required|max:50|unique:users,email'
                    ]);
                }
                if($user->role_id != $request->input('role')){
                    $request->validate([
                    'role' => 'string|required'
                    ]);
                }

                $user->name = $request->input('name');
                $user->email = $request->input('email');
                $user->role_id = $request->input('role');
                $user->save();
                return redirect( route('users.index'));
            }
        }        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,User $user)
    {
        //
        $user->delete();
        $request->session()->flash('status',"User $user->name deleted successfully.");

        // return redirect("/users");
        return redirect( route('users.index'));
    }

}
