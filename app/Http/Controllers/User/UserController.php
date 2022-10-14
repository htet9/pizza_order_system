<?php

namespace App\Http\Controllers\User;

use Storage;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //* user home page
    public function home() {
        $pizza = Product::orderBy('created_at', 'desc')->get();
        $category = Category::get();
        $cart = Cart::where('user_id', Auth::user()->id)->get();
        $history = Order::where('user_id', Auth::user()->id)->get();
        return view('user.main.home', compact('pizza', 'category', 'cart', 'history'));
    }

    //* change password page
    public function changePasswordPage() {
        return view('user.password.change');
    }

    //* change password
    public function changePassword(Request $request) {
        $this->passwordValidationCheck($request);

        $user = User::select('password')->where('id', Auth::user()->id)->first();
        $dbPassword = $user->password; // hashed value

        if (Hash::check($request->oldPassword, $dbPassword)) {
            $data = ['password' => Hash::make($request->newPassword)];
            User::where('id', Auth::user()->id)->update($data);
        }
        return back()->with(['success' => 'Password reset success.']);
    }

    //* user account change page
    public function accountChangePage() {
        return view('user.profile.account');
    }

    //* user account change
    public function accountChange(Request $request, $id) {
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

        return back()->with(['updateSuccess' => 'Account Updated Successfully.']);
    }

    //* filtering
    public function filter($categoryId) {
        $pizza = Product::where('category_id', $categoryId)->orderBy('created_at', 'desc')->get();
        $category = Category::get();
        $cart = Cart::where('user_id', Auth::user()->id)->get();
        $history = Order::where('user_id', Auth::user()->id)->get();
        return view('user.main.home', compact('pizza', 'category', 'cart', 'history'));
    }

    //* direct pizza details page
    public function pizzaDetails($pizzaId) {
        $pizza = Product::where('id', $pizzaId)->first();
        $pizzaList = Product::get();
        return view('user.main.details', compact('pizza', 'pizzaList'));
    }

    //* cart list page
    public function cartList() {
        $cartList = Cart::select('carts.*', 'products.name as pizza_name', 'products.price as pizza_price', 'products.image as pizza_image')
                    ->leftJoin('products', 'products.id', 'carts.product_id')
                    ->where('carts.user_id', Auth::user()->id)
                    ->get();

        $totalPrice = 0;
        foreach($cartList as $c) {
            $totalPrice += $c->pizza_price * $c->qty;
        }

        return view('user.main.cart', compact('cartList', 'totalPrice'));
    }

    //* cart history page
    public function cartHistory() {
        $order = Order::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(5);
        return view('user.main.history', compact('order'));
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
}
