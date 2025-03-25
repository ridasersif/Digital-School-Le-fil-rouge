<?php

namespace App\Repositories\Admin;

use App\Exceptions\Admin\Category\CategoryNotFoundException;
use App\Interfaces\Admin\CategoryInterface;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class CategoryRepository implements CategoryInterface
{
   
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function getCategories(){
        return Category::orderBy('id', 'desc')->paginate(4);
    }
    public function saveCategory($request){
        return Category::create([
            'nom' => $request->nom,
            'icon' => $request->icon,
            'description' => $request->description,
            'created_by' => Auth::id()
        ]);
    }
    public function updateCategory($request, $id)
    {
        $category = Category::findOrFail($id);
        $category->update([
            'nom' => $request->nom,
            'icon' => $request->icon,
            'description' => $request->description,
            'created_by' => Auth::id(),
        ]);
    }
    public function deleteCategory($id)
    {
       
        $category = Category::findOrFail($id);
        $category->delete();
    }

}
