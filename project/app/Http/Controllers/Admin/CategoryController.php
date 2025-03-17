<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Catch_;

class CategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      
        $categories = Category::paginate(4);
        return view('admin.categories.index', compact('categories'));
    }
    /**
     * Store a newly created resource in storage.
     */
   
    
     public function store(StoreCategoryRequest $request)
     {
        $formFields=$request->file('avatar')->store('categories','public');
         Category::create([
             'nom' => $request->nom,
             'avatar' => $formFields,
             'description' => $request->description,
             'created_by' => Auth::id()
         ]);
     
         return redirect()->route('categories.index')->with('success', 'Category créée avec succès!');
     }
     

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $category = Category::findOrFail($category);
    return view('categories.index', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        // return redirect()->route('categories.index')->with('success', 'Catégorie supprimée avec succès!');
        return response()->json(['success' => true]);
   
    }
}
