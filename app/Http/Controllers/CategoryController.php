<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    //index category
    public function index(){
        $categories = Category::paginate(10);
        return view('pages.categories.index', compact('categories'));
    }

    //create category
    public function create(){
        return view('pages.categories.create');
    }

    //store category
    public function store(Request $request){
        //validate the request...
        $request->validate([
            'name' => 'required',
        ]);

        //store the req
        $category = new Category;
        $category->name = $request->name;
        $category->description = $request->description;

        //save image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->storeAs('public/categories', $category->id . '.' . $image->getClientOriginalExtension());
            $category->image = 'storage/categories/' . $category->id . '.' . $image->getClientOriginalExtension();
            $category->save();
        }

        return redirect()->route('categories.index')->with('success', 'Category created successfully');
    }

    //show category
    public function show($id){
        return view('pages.categories.show');
    }

    //edit category
    public function edit($id){
        $category = Category::find($id);
        return view('pages.categories.edit', compact('category'));
    }

    //update category
    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required'
        ]);

        $category = Category::find($id);
        $category->name = $request->name;
        $category->description = $request->description;


        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->storeAs('public/categories', $category->id . '.' . $image->getClientOriginalExtension());
            $category->image = 'storage/categories/' . $category->id . '.' . $image->getClientOriginalExtension();
            $category->save();
        }

        return redirect()->route('categories.index')->with('success', 'Category updated successfully');
    }


    public function destroy($id){

        $category = Category::find($id);
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully');
    }
}
