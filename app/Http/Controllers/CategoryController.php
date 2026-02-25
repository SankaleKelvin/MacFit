<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //CRUD FUNCTIONS
    //Create
    public function createCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:categories,name',
            'description' => 'nullable|string|max:1000'
        ]);

        $category = new Category();
        $category->name = $validated['name'];
        $category->description = $validated['description'];
        try {
            $category->save();
            return response()->json([
                'message' => 'Category Saved Successfully.'
            ], 200);
        } catch (\Exception $exception) {
            return response()->json([
                'error' => 'Failed to Save a Category.',
                'message' => $exception->getMessage()
            ], 200);
        }
    }

    //Read All Categories
    public function readAllCategories()
    {
        try {
            $categories = Category::all();
            return response()->json($categories);
        } catch (\Exception $exception) {
            return response()->json([
                'error' => 'Failed to fetch Categories.',
                'message' => $exception->getMessage()
            ], 200);
        }
    }


    //Read Category(id)
    public function readCategory($id)
    {
        try {
            $category = Category::findOrFail($id);
            return response()->json($category);
        } catch (\Exception $exception) {
            return response()->json([
                'error' => 'Failed to fetch the Category.',
                'message' => $exception->getMessage()
            ], 200);
        }
    }

    //Update category(id)
    public function updateCategory(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:categories,name',
            'description' => 'nullable|string|max:1000'
        ]);

        $category = Category::findOrFail($id);
        $category->name = $validated['name'];
        $category->description = $validated['description'];
        try {
            $category->save();
            return response()->json([
                'message' => 'Category Updated Successfully.'
            ], 200);
        } catch (\Exception $exception) {
            return response()->json([
                'error' => 'Failed to Update the Category.',
                'message' => $exception->getMessage()
            ], 200);
        }
    }

    //Delete category(id)
    public function deleteCategory($id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->delete();
            return response('Category Deleted Successfully');
        } catch (\Exception $exception) {
            return response()->json([
                'error' => 'Failed to Delete the Category.',
                'message' => $exception->getMessage()
            ], 200);
        }
    }
}
