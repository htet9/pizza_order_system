<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    //* user side contact page
    public function contact() {
        return view('user.main.contact');
    }

    //* contact form action
    public function contactForm(Request $request) {
        $this->contactValidationCheck($request, 'create');

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ];

        Contact::create($data);
        return back();
    }

    //* product validation check
    private function contactValidationCheck($request, $action) {
        $validationRules = [
            'name' => 'required',
            'email' => 'required',
            'message' => 'required|min:10',
        ];

        Validator::make($request->all(), $validationRules)->validate();
    }

    //* direct admin contact list
    public function contactList() {
        $contact = Contact::orderBy('id', 'desc')->get();
        return view('admin.user.contactList', compact('contact'));
    }
}
