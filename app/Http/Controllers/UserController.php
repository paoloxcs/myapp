<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Validator;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $users = User::with(['role' => function($query){
                $query->where('section', '=', 'panel');
            }])->orderBy('id','DESC')->paginate(6);

            return response()->json($users, 200);
        }


        return view('panel.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::where('section', 'panel')->get();

        return response()->json($roles, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name'      =>  'required|string',
            'email'     =>  'required|email|unique:users',
            'last_name' =>  'required|string',
            'role'      =>  'required',
            'password'  =>  'required'
        ]);

        if($validation->fails()){
            return response()->json(['errors' => $validation->errors()], 422);
        }

        User::create([
            'name'      =>  $request->name,
            'last_name' =>  $request->last_name,
            'email'     =>  $request->email,
            'role_id'   =>  $request->role,
            'password'  =>  bcrypt($request->password),  
        ]);


        return response()->json(['message' => 'Usuario registrado'], 201);
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
    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'name'      =>  'required|string',
            'email'     =>  'required|email|unique:users,email,'.$id.',id',
            'last_name' =>  'required|string',
            'role'      =>  'required'
        ]);

        if($validation->fails()){
            return response()->json(['errors' => $validation->errors()], 422);
        }

        $user = User::findOrFail($id);
        $user->name         =   $request->name;
        $user->email        =   $request->email;
        $user->last_name    =   $request->last_name;
        $user->role_id      =   $request->role;
        $user->save();

        return response()->json(['message' => 'Usuario actualizado'], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return response()->json(['message' => 'Usuario eliminado'], 200);
    }
}
