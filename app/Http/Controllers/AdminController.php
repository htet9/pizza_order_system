<?php

namespace App\Http\Controllers;

use Storage;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //* direct password reset page
    public function resetPage() {
        return view('admin.account.resetPassword');
    }

    // reset password
    public function resetPassword(Request $request) {
        /*
            1. all fields must be filled
            2. new password & confirm password lenght must be greater than 8
            3. new password & confirm password must be same
            4. client old password must be same with db password
            5. reset password
        */
        $this->passwordValidationCheck($request);

        $user = User::select('password')->where('id', Auth::user()->id)->first();
        $dbPassword = $user->password; // hashed value

        if (Hash::check($request->oldPassword, $dbPassword)) {
            $data = ['password' => Hash::make($request->newPassword)];
            User::where('id', Auth::user()->id)->update($data);

            Auth::logout();
            return redirect()->route('auth#loginPage');
        }
        return back()->with(['notMatch' => 'The Old Password does not match. Try again.']);
    }

    //* direct admin profile page
    public function details() {
        return view('admin.account.details');
    }

    //* update admin profile
    public function update($id, Request $request) {
        $this->accountValidationCheck($request);
        $data = $this->getUserData($request);

        // for image | Steps => old image name->check-> delete-> store
        if ($request->hasFile('image')) {
            $dbImage = User::where('id', $id)->first();
            $dbImage = $dbImage->image;

            if ($dbImage != null) {
                Storage::delete('public/'.$dbImage);
            }

            $fileName = uniqid() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $fileName);
            $data['image'] = $fileName;
        }

        User::where('id', $id)->update($data);

        return redirect()->route('admin#info')->with(['updateSuccess' => 'Admin Account Updated Successfully.']);
    }

    //* admin list page
    public function list() {
        $admin = User::when(request('key'), function($query) {
                    $query->orWhere('name', 'like', '%'.request('key').'%')
                          ->orWhere('email', 'like', '%'.request('key').'%')
                          ->orWhere('gender', 'like', '%'.request('key').'%')
                          ->orWhere('phone', 'like', '%'.request('key').'%')
                          ->orWhere('address', 'like', '%'.request('key').'%');
                })
                ->where('role', 'admin')->paginate(3);

        $admin->appends(request()->all());
        return view('admin.account.list', compact('admin'));
    }

    //! admin acc delete
    public function delete($id) {
        User::where('id', $id)->delete();
        return back()->with(['deleteSuccess' => 'Admin Account Deleted Successfully.']);
    }

    //* change admin role
    public function changeRole(Request $request) {
        $updateSource = ['role' => $request->role];
        User::where('id', $request->adminId)->update($updateSource);
    }

    //* change
    public function change(Request $request, $id) {
        $data = $this->requestUserData($request);
        User::where('id', $id)->update($data);
        return redirect()->route('admin#list');
    }

    //* request user acc data
    private function requestUserData($request) {
        return [
            'role' => $request->role
        ];
    }

    //* request user data
    private function getUserData($request) {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'address' => $request->address,
        ];
    }

    //* account validation check
    private function accountValidationCheck($request) {
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'image' => 'mimes:png,jpg,jpeg,webp|file'
        ])->validate();
    }

    //* password validation
    private function passwordValidationCheck($request) {
        Validator::make($request->all(), [
            'oldPassword' => 'required|min:8',
            'newPassword' => 'required|min:8',
            'confirmPassword' => 'required|min:8|same:newPassword',
        ])->validate();
    }

    //* direct admin edit info page
    public function edit() {
        return view('admin.account.edit');
    }
}
