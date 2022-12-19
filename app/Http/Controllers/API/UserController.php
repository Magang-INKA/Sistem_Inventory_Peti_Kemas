<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::latest()->get();
        return response()->json(
            [
                'status' => 200,
                'message' => 'Data berhasil ditampilkan',
                'data' => $data
            ]
        );
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
        $data = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => $request->password,
            'telepon' => $request->telepon,
            'role' => $request->role
         ]);

        return response()->json(
            [
                'status' => 200,
                'message' => 'Data created successfully.',
                'data' => $data
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$data = User::find($id);
        $data = DB::table('users')
                ->select('id','name','email','no_telp','role')
                ->where('id','=',$id)->first();
                //->get();
        if (is_null($data)) {
            return response()->json(
                [
                    'status' => 404,
                    'message' => 'Data not found'
                ]
            );
        }
        // return response()->json(
        //     [
        //         'status' => 200,
        //         'message' => 'Data berhasil ditampilkan',
        //         'data' => $data
        //     ]
        // );
        return response()->json($data);
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
    public function update(Request $request, User $user)
    {
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->password = $request->password;
        $user->telepon = $request->telepon;
        $user->role = $request->role;
        $user->save();

        return response()->json(
            [
                'status' => 200,
                'message' => 'Data updated successfully.',
                'data' => $user
            ]
        );
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
        return response()->json(
            [
                'status' => 200,
                'message' => 'Data deleted successfully'
            ]
        );
    }

    public function email(Request $request, $id)
    {
        $dp=User::find($id);
        $dp->update($request->all());
        return response()->json(['message'=>'Success','data'=>$dp]);
    }
    public function telp(Request $request, $id)
    {
        $dp=User::find($id);
        $dp->update($request->all());
        return response()->json(['message'=>'Success','data'=>$dp]);
    }
    public function password(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|string|min:5|confirmed',
            'password_confirmation' => 'required',
        ]);

        $user = User::find($id);
        $user->password = Hash::make($request->password);
        $user->save();

        // $dp=User::find($id);
        // $dp->update($request->all());
        return response()->json(['message'=>'Success','data'=>$user]);
    }
}