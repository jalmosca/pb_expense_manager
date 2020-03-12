<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Role $role)
    {
        $this->authorize('viewAny',$role);
        $roles = Role::all();
        return view('roles.index')->with('roles',$roles);
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
            'name' => 'string|required|max:50|unique:roles,name'
        ]);
        // $name = $request->input('name');

        $role = new Role;
        $role->name = $request->input('name');
        if($request->input('description')!=null){
            $role->description = $request->input('description');
        }
        $role->save();
        return redirect( route('roles.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        //
        // if($role->name == $request->input('name') && $role->description == $request->input('description')){
        //     return redirect( route('roles.index'));
        // } else {
        //
        if($role->name != $request->input('name')){
            $request->validate([
                'name' => 'string|required|max:50|unique:roles,name'
            ]);
        }

        $role->name = $request->input('name');
        $role->description = $request->input('description');
        // dd($request->input('name'));

        $role->save();
        // $request->session()->flash('status',"Update successful on $role->name role");
        return redirect( route('roles.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,Role $role)
    {
        //
        $role->delete();
        $request->session()->flash('status',"Role $role->name deleted successfully.");

        // return redirect("/roles");
        return redirect( route('roles.index'));
    }
}
