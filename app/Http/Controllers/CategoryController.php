<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use DB;
use Excel;

class CategoryController extends Controller
{
    public function index()
    {
        return view('categories.index');
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        try {
            $category = Category::firstOrCreate([
                'name' => $request->name, 
                'description' => $request->description
            ]);

            return redirect(route('category.index'))->with(['success' => 'Category: <strong>' . $category->name . '</strong> has been submitted.']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);

        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        try {
            $category = Category::findOrFail($id);

            $category->update([
                'name' => $request->name,
                'description' => $request->description
            ]);

            return redirect(route('category.index'))->with(['success' => 'Category: ' . $category->name . ' has been modified.']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        $category->delete();

        return redirect()->back()->with(['success' => 'Category: <strong>' . $category->name . '</strong> was deleted.']);
    }

    public function getData()
    {
        $categories = Category::all();

        $i = 0;
        $data = [];
        $output = array(
            "data" => []
        );

        foreach ($categories as $key => $value) {
            $link_edit = route('category.edit', $value->id);
            $link_delete = route('category.destroy', $value->id);
            $output['data'][$i][] = $key+1;
            $output['data'][$i][] = $value->name;
            $output['data'][$i][] = $value->description;
            $output['data'][$i][] = '
                <form action="' . $link_delete . '" method="post">
                    <a href="' . $link_edit . '" class="btn btn-warning btn-xs" data-popup="tooltip" title="Edit Category"><i class="fa fa-edit"></i></a>
                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                    <input type="hidden" name="_method" value="DELETE">
                    <button class="btn btn-danger btn-xs" data-popup="tooltip" title="Delete Category"><i class="fa fa-trash"></i></button>
                </form>';
            $i++;
        }

        echo json_encode($output);
    }

    public function importExcel(Request $request)
    {
        if ($request->hasFile('file')) {
            Excel::load($request->file('file')->getRealPath(), function ($reader) {
                foreach ($reader->toArray() as $key => $row) {
                    $data['name'] = $row['name'];
                    $data['description'] = $row['description'];

                    if (!empty($data)) {
                        DB::table('categories')->insert($data);
                    }
                }
            });
        }

        return redirect()->back()->with(['success' => 'File has been imported to database.']);
    }
}
