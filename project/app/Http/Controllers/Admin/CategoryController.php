<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Categories\StoreCategoryRequest;

use App\Http\Requests\Admin\Categories\UpdateCategoryRequest;
use App\Interfaces\Admin\CategoryInterface;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Catch_;

class CategoryController extends Controller
{
    public $categoryRepository;
     /**
     * constrecure .
     */
    public function __construct(CategoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = $this->categoryRepository->getCategories();
        return view('admin.categories.index', compact('categories'));
    }
    /**
     * Store a newly created resource in storage.
     */
     public function store(StoreCategoryRequest $request)
     {
        $this->categoryRepository->saveCategory($request);
        return redirect()->route('categories.index')->with('success', 'Catégorie créée avec succès!');

     }
     public function update(UpdateCategoryRequest $request, $id)
     {
         $this->categoryRepository->updateCategory($request, $id);
         return redirect()->route('categories.index')->with('success', 'Catégorie modifiée avec succès!');
     }
     public function destroy($id)
     {
         $this->categoryRepository->deleteCategory($id);
         return response()->json(['success' => true]);
     }
}
