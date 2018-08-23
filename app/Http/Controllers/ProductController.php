<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use File;
use Image;

class ProductController extends Controller
{
    public function index()
    {
        return view('products.index');
    }

    public function create()
    {
        $categories = Category::orderBy('name', 'ASC')->get();

        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        try {
            $photo = null;

            if ($request->hasFile('photo')) {
                $photo = $this->saveFile($request->name, $request->file('photo'));
            }

            $product = Product::create([
                'code' => $request->code,
                'name' => $request->name,
                'description' => $request->description,
                'stock' => $request->stock,
                'price' => $request->price,
                'category_id' => $request->category_id,
                'photo' => $photo
            ]);
            
            return redirect(route('product.index'))->with(['success' => '<strong>' . $product->name . 'Product: </strong> has been submitted.']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if (!empty($product->photo)) {
            File::delete(public_path('uploads/product/' . $product->photo));
        }

        $product->delete();

        return redirect()->back()->with(['success' => 'Product: <strong>' . $product->name . '</strong> was deleted.']);
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);

        $categories = Category::orderBy('name', 'ASC')->get();

        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        try {
            $product = Product::findOrFail($id);
            
            $photo = $product->photo;

            if ($request->hasFile('photo')) {
                !empty($photo) ? File::delete(public_path('uploads/product/' . $photo)) : null;
                $photo = $this->saveFile($request->name, $request->file('photo'));
            }

            $product->update([
                'name' => $request->name,
                'description' => $request->description,
                'stock' => $request->stock,
                'price' => $request->price,
                'category_id' => $request->category_id,
                'photo' => $photo
            ]);
            
            return redirect(route('product.index'))->with(['success' => 'Product: <strong>' . $product->name . '</strong> has been modified.']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    private function saveFile($name, $photo)
    {
        // file name = product name + time + extension
        $images = str_slug($name) . time() . '.' . $photo->getClientOriginalExtension();

        // path for uploaded photo
        $path = public_path('uploads/product');

        // check if folder do not exist
        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }

        // if folder exist
        Image::make($photo)->save($path . '/' . $images);

        return $images;
    }

    public function getData()
    {
        $products = Product::with('category')->orderBy('created_at', 'DESC')->get();

        $i = 0;
        $data = [];
        $output = array(
            "data" => []
        );

        foreach ($products as $key => $value) {
            $link_edit = route('product.edit', $value->id);
            $link_delete = route('product.destroy', $value->id);
            $output['data'][$i][] = $key+1;
            $output['data'][$i][] = $value->code;
            $output['data'][$i][] = $value->name;
            $output['data'][$i][] = $value->stock;
            $output['data'][$i][] = $value->price;
            $output['data'][$i][] = $value->category->name;
            $output['data'][$i][] = date('j M Y h:i', strtotime($value->updated_at));
            $output['data'][$i][] = '
                <form action="' . $link_delete . '" method="POST">
                    <a href="' . $link_edit . '" class="btn btn-warning btn-xs" data-popup="tooltip" title="Edit Product"><i class="fa fa-edit"></i></a>
                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                    <input type="hidden" name="_method" value="DELETE">
                    <button class="btn btn-danger btn-xs" data-popup="tooltip" title="Delete Product"><i class="fa fa-trash"></i></button>
                </form>';
            $i++;
        }

        echo json_encode($output);
    }
}
