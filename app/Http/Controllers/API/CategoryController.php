<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function categoryList() {
        $allCategories = Category::select('id', 'title')->orderBy('id', 'asc')->get();

        return response(['status' => 'success', 'all_categories' => $allCategories]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allCategories = Category::select('id', 'title')->orderBy('id', 'desc')->paginate(20);
        
        return response(['all_categories' => $allCategories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try
        {
            $validatedData = $request->validate([
                'title' => 'required|string|max:255'
            ]);

            $categoryData = $request->all();
            Category::create($categoryData);

            return response([ 'status' => 'success', 'message' => 'Category Created Successfully.'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $category = Category::select('id', 'title')->findOrFail($id);
            return response(['status' => 'success', 'category' => $category], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'failed', 'error' => $e->getMessage()], 500);
        } 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try
        {
            $validatedData = $request->validate([
                'title' => 'required|string|max:255'
            ]);

            $categoryData = $request->all();
            $category = Category::findOrFail($id);

            $category->update($categoryData);

            return response([ 'status' => 'success', 'message' => 'Category Updated Successfully.'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try
        {
            $category = Category::findOrFail($id);
            $category->delete();
            return response(['status' => 'success', 'message' => 'Category deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
