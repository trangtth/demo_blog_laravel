<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Validator;
use Auth;
use App\User;
use App\Http\Requests\UserRequest;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();

        return view('admin.users.index', [
            'users' => $users,
            'isAdmin' => User::$ROLE[Auth::user()->role] == 'admin',
            'roleUser' => User::$ROLE
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $users)
    {
        $roleUser = User::$ROLE;
        return view('admin.users.show', compact('users', 'roleUser'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $users)
    {
        $roleUser = User::$ROLE;
        return view('admin.users.edit', compact('users', 'roleUser'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $users)
    {
        $data = $request->all();

        $users->update($data);

        return redirect('admin/users');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $users)
    {
        $result = $users->delete();

        if ($result) {
            return response()->json(['responseText' => 'User was deleted.', 'status' => 200], 200);
        }
    }
}
