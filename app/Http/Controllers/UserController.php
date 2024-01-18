<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy('id', 'DESC')->get();
        return view('pages.user', [
            'title' => 'List User',
            'active' => 'user',
            'users' => $users,

        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // dd($request->file('file'));

        $remember_token  = Str::random(20).time();

        if ($request->file('file') != null) {
            # code...
            $fileName = time() . $request->file('file')->getClientOriginalName();
            $path = $request->file('file')->storeAs('Image-Profile', $fileName, 'public');
        }   
        else{
            $path = null;
            $fileName = null;
        }




        $data = [
            'username' => $request->username,
            'password' => $request->password,
            'name' => $request->name,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'role' => $request->role,
            'img' => $fileName,
            'remember_token' => $remember_token,
        ];

        $data['password']= Hash::make($data['password']);
        // dd($data);


        User::create($data);
        return response()->json([
            'success'   => true
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //

        $User = User::find($id);

        return response()->json([
            'result' => $User,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //

        // dd($request, $id);

        $users = User::findOrFail($id);

        $data = [
            "role" => $request->role,
            "password" => $request->password,
        ];

        $data['password']= Hash::make($data['password']);


        $users->update($data);
        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $users = User::find($id);
        $users->delete();
        return response()->json([
            'success'   => true
        ]);
    }



    public function edit_profile(Request $request, $remember_token){
        $id = User::where("remember_token", $remember_token)->value("id");
        $users = User::find($id);

        return view('pages.edit_profile', [
            'title' => 'Edit User',
            'active' => 'user',
            'users' => $users,

        ]);
    }
    public function update_profile(Request $request, $remember_token){

        // dd($request);
        $id = User::where("remember_token", $remember_token)->value("id");
        $users = User::find($id);

        if($request->old_pic_profile){
            Storage::delete('public/Image-Profile/'.$request->old_pic_profile);
        }


        if ($request->file('file') != null) {
            # code...
            $fileName = time() . $request->file('file')->getClientOriginalName();
            $path = $request->file('file')->storeAs('Image-Profile', $fileName, 'public');
        }   
        else{
            $path = null;
            $fileName = null;
        }


        $data = [
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'role' => $request->role,
            'img' => $fileName,
        ];

        // $data['password']= Hash::make($data['password']);

        $users->update($data);
        return response()->json([
            'success'   => true
        ]);
    }
}
