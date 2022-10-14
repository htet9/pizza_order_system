<?php

namespace App\Http\Controllers;

use Storage;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //* product list page
    public function list() {
        $pizzas = Product::select('products.*', 'categories.name as category_name')
        ->when(request('key'), function($query) {
                $query->where('products.name','like','%'.request('key').'%');
            })
                ->leftJoin('categories', 'products.category_id', 'categories.id')
                ->orderBy('products.created_at', 'desc')
                ->paginate(4);

        $pizzas->appends(request()->all());
        return view('admin.product.pizzaList', compact('pizzas'));
    }

    //* pizza create page
    public function createPage() {
        $categories = Category::select('id', 'name')->get();
        return view('admin.product.create', compact('categories'));
    }

    //TODO:: create pizza
    public function create(Request $request) {
        $this->productValidationCheck($request, 'create');
        $data = $this->requestProductInfo($request);

        $fileName = uniqid() . '_' . $request->file('pizzaImage')->getClientOriginalName();
        $request->file('pizzaImage')->storeAs('public', $fileName);
        $data['image'] = $fileName;

        Product::create($data);
        return redirect()->route('product#list');
    }

    //* pizza details page
    public function details($id) {
        $pizza = Product::select('products.*', 'categories.name as category_name')
                    ->leftJoin('categories', 'products.category_id', 'categories.id')
                    ->where('products.id', $id)->first();
        return view('admin.product.details', compact('pizza'));
    }

    //* edit pizza page
    public function editPage($id) {
        $category = Category::get();
        $pizza = Product::where('id', $id)->first();
        return view('admin.product.edit', compact('pizza', 'category'));
    }

    //TODO:: update pizza data
    public function update(Request $request) {
        $this->productValidationCheck($request, 'update');
        $data = $this->requestProductInfo($request);

        if ($request->hasFile('pizzaImage')) {
            $oldImageName = Product::where('id', $request->pizzaId)->first();
            $oldImageName = $oldImageName->image;

            if ($oldImageName != null) {
                Storage::delete('public/'.$oldImageName);
            }

            $fileName = uniqid().'_'.$request->file('pizzaImage')->getClientOriginalName();
            $request->file('pizzaImage')->storeAs('public', $fileName);
            $data['image'] = $fileName;
        }

        Product::where('id', $request->pizzaId)->update($data);
        return redirect()->route('product#list')->with(['pizzaUpdate' => 'Product updated successfully.']);
    }

    //! delete pizza
    public function delete($id) {
        Product::where('id', $id)->delete();
        return redirect()->route('product#list')->with(['pizzaDelete' => 'Product deleted successfully.']);
    }

    //* request product info
    private function requestProductInfo($request) {
        return [
            'category_id' => $request->pizzaCategory,
            'name' => $request->pizzaName,
            'description' => $request->pizzaDescription,
            'price' => $request->pizzaPrice,
            'waiting_time' => $request->pizzaWaitingTime,
        ];
    }

    //* product validation check
    private function productValidationCheck($request, $action) {
        $validationRules = [
            'pizzaName' => 'required|min:5|unique:products,name,'.$request->pizzaId,
            'pizzaCategory' => 'required',
            'pizzaDescription' => 'required|min:10',
            'pizzaPrice' => 'required',
            'pizzaWaitingTime' => 'required'
        ];

        $validationRules['pizzaImage'] = $action == 'create' ? 'required|mimes:png,jpg,jpeg,webp|file' : 'mimes:png,jpg,jpeg,webp|file';

        Validator::make($request->all(), $validationRules)->validate();
    }
}
