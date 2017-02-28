<?php

namespace App\Http\Controllers;

use Auth;
use App\User;

use Validator;

use App\Http\Requests;
use App\Http\Requests\UserRequest;

use App\DataTables\UsersDataTable;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->render('admin.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $users)
    {
        $roleUser = config('auth.roles');
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
        $roleUser = config('auth.roles');
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
