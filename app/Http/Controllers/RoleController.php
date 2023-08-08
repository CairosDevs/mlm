<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function form()
    {
        $users = User::select('id', 'name', 'lastName')->get();
        $roles = Role::where('name', '!=', 'System')->get();

        foreach ($users as $user) {
            $user->roles = $user->getRoleNames();
        }

        return view('roles.form')->with('users', $users)->with('roles', $roles);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
        ]);

        try {
            $user = User::findOrFail($id);
            $user->roles()->sync([$request->role_id]);

            return response()->json([
            'success' => 'El rol del usuario fue actualizado',
            ]);
        } catch (\Exception $e) {
            // Handle any errors that may occur
            return response()->json([
            'error' => 'An error occurred while updating the user role',
            ], 500);
        }
    }

}
