<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{

    public function listSubCategories($category_id) {
        $allSubCategories = SubCategory::select('id', 'title')->where('category_id', $category_id)->orderBy('id', 'asc')->get();
        
        return response(['status' => 'success', 'all_subCategories' => $allSubCategories]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allSubCategories = SubCategory::with('category:id,title')->select('id', 'title', 'category_id', 'score')->orderBy('id', 'desc')->paginate(20);
        return response(['all_subCategories' => $allSubCategories]);
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
                'title' => 'required|string|max:255',
                'category_id' => 'required',
                'score' => 'required'
            ]);

            $categoryData = $request->all();
            SubCategory::create($categoryData);

            return response([ 'status' => 'success', 'message' => 'Sub Category Created Successfully.'], 200);
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
            $category = SubCategory::select('id', 'title', 'category_id', 'score')->findOrFail($id);
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
                'title' => 'required|string|max:255',
                'category_id' => 'required',
                'score' => 'required'
            ]);

            $categoryData = $request->all();
            $category = SubCategory::findOrFail($id);

            $category->update($categoryData);

            return response([ 'status' => 'success', 'message' => 'Sub Category Updated Successfully.'], 200);
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
            $category = SubCategory::findOrFail($id);
            $category->delete();
            return response(['status' => 'success', 'message' => 'Sub Category deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
