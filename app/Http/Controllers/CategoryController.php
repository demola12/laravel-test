<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return response()->json(['categories' => $categories], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories',
            'description' => 'required',
            
        ]);

        $category = Category::create($request->all());
        return response()->json(['category' => $category], 201);
    }
}
