<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Categories\StoreCategoryRequest;

use App\Http\Requests\Admin\Categories\UpdateCategoryRequest;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Catch_;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('id', 'desc')->paginate(4);
        return view('admin.categories.index', compact('categories',));
    }
    /**
     * Store a newly created resource in storage.
     */
     public function store(StoreCategoryRequest $request)
     {
      
         Category::create([
             'nom' => $request->nom,
             'icon' => $request->icon, 
             'description' => $request->description,
             'created_by' => Auth::id()
         ]);
         return redirect()->route('categories.index')->with('success', 'Category créée avec succès!');
     }
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update([
            'nom' => $request->nom,
            'icon' => $request->icon, 
            'description' => $request->description,
            'created_by' => Auth::id()
        ]);
    
        return redirect()->route('categories.index',compact('isUpdate'))->with('success', 'Category modifie avec succès!');
    }
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json(['success' => true]);
   
    }
}
