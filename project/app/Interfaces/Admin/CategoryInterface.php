<?php

namespace App\Interfaces\Admin;

interface CategoryInterface
{
    public function getCategories();
    public function saveCategory($request);
    public function updateCategory($request, $id);
    public function deleteCategory($id);
}
