<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserAccController extends Controller
{
    //* user list page
    public function userList() {
        $users = User::where('role', 'user')->orderBy('created_at', 'desc')->paginate(4);
        return view('admin.user.list', compact('users'));
    }

    //* user role change
    public function userChangeRole(Request $request) {
        $updateSource = ['role' => $request->role];
        User::where('id', $request->userId)->update($updateSource);
    }

    //* delete user acc
    public function userDelete($id) {
        User::where('id', $id)->delete();
        return redirect()->route('admin#userList');
    }
}
