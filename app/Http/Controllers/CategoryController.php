<?php

namespace App\Http\Controllers;
use App\Category;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    
    
    // manage category
    public function manageCategory()
    {
        $datacategory = Category::paginate(15);

        return view('book.manage-category', ['categories' => $datacategory]);
    }
    // add category

    public function addcategory(Request $request)
    {
        $category = Category::all();
        /*Validator form penambahan category*/
        $rules = [

            'name' => 'required|unique:categories'
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect("add-category")->withErrors($validator)->withInput();
        }

        $newCategories = new Category();
        $newCategories->name = $request['name'];

        $newCategories->save();

        return redirect("manage-category")->with('info', 'New Category has been created.');
    }
    // delete category

    public function deleteCategory($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect("manage-category")->with('danger', 'Category has been deleted.');
    }
    // ini untuk search category manage (Admin)
    public function searchcategory(Request $request)
    {

        $categories = Category::selectRaw('categories.id, categories.name')
            ->whereRaw(
                'categories.name = ?',
                [$request->search]
            )
            ->paginate(15);

        $search = $request->search;

        return view('book.manage-category', compact('categories', 'search'));
    }
    // ini untuk edit category (admin)
    public function editcategory($id)
    {
        $editcategory = Category::find($id);
        return view('book.edit-category', ['categories' => $editcategory]);
    }

    public function doeditcategory(Request $request, $id)
    {

        /*Validator update category */
        $rules = [
            'name' => 'required|unique:categories',

        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect("edit-category/$id")->withErrors($validator)->withInput();
        }

        /*Mengambil data user sesuai id untuk di update dengan data yang baru*/
        $category = Category::find($id);
        // ini untuk validasi
        $category->name = $request['name'];

        $category->save();
        // untuk meredirect dan memberikan notif sukses
        return redirect("manage-category")->with('success', 'Category has been updated.');
    }
}
