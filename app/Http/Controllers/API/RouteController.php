<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{
    public function productList(){
        $products = Product::get();
        $category = Category::get();

        $data = [
            'product' => $products,
            'category' => $category
        ];
        return response()->json($data, 200);
    }

    public function orderList() {
        $orders = Order::get();
        return response()->json($orders, 200);
    }

    public function userList() {
        $users = User::get();
        return response()->json($users, 200);
    }

    public function contactList() {
        $contacts = Contact::get();
        return response()->json($contacts, 200);
    }

    //* post method create category
    public function createCategory(Request $request) {
        $data = [
            'name' => $request->name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        $response = Category::create($data);
        return response()->json($response, 200);
    }

    public function createContact(Request $request){
        $data = $this->getContactData($request);
        Contact::create($data);
        $contact = Contact::orderBy('created_at', 'desc')->get();

        return response()->json($contact, 200);
    }

    //* delete category
    public function deleteCategory(Request $request) {
        $data = Category::where('id', $request->category_id)->first();

        if (isset($data)) {
            Category::where('id', $request->category_id)->delete();
            return response()->json(['status' => 'true', 'message' => 'delete success', 'deleteData' => $data], 200);
        }
        return response()->json(['status' => 'false', 'message' => 'there is no such category id'], 200);
    }

    //* category details
    public function categoryDetails($id) {
        $data = Category::where('id', $id)->first();

        if (isset($data)) {
            Category::where('id', $id)->delete();
            return response()->json(['status' => 'true', 'category' => $data], 200);
        }
        return response()->json(['status' => 'false', 'message' => 'there is no such category...'], 200);
    }

    //* update category
    public function updateCategory(Request $request) {
        $categoryId = $request->category_id;
        $dbSource = Category::where('id', $categoryId)->first();

        if (isset($dbSource)) {
            $data = $this->getCategoryData($request);
            Category::where('id', $categoryId)->update($data);
            $response = Category::where('id', $categoryId)->first();
            return response()->json(['status' => 'true', 'message' => 'update success', 'category' => $response], 200);
        }

        return response()->json(['status' => 'false', 'message' => 'there is no such category...'], 200);
    }

    //* get contact data
    private function getContactData($request) {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }

    //* get category data
    private function getCategoryData($request) {
        return [
            'name' => $request->category_name,
            'updated_at' => Carbon::now()
        ];
    }
}
