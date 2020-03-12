<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category)
    {
        $this->authorize('viewAny',$category);
        $categories = Category::all();
        return view('categories.index')->with('categories',$categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'string|required|max:50|unique:categories,name'
        ]);
        // $name = $request->input('name');

        $category = new Category;
        $category->name = $request->input('name');
        if($request->input('description')!=null){
            $category->description = $request->input('description');
        }
        $category->save();
        return redirect( route('categories.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
        // if($category->name == $request->input('name') && $category->description == $request->input('description')){
        //     return redirect( route('categories.index'));
        // } else {
        //
        if($category->name != $request->input('name')){
            $request->validate([
                'name' => 'string|required|max:50|unique:categories,name'
            ]);
        }

        $category->name = $request->input('name');
        $category->description = $request->input('description');
        // dd($request->input('name'));

        $category->save();
        // $request->session()->flash('status',"Update successful on $category->name category");
        return redirect( route('categories.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,Category $category)
    {
        //
        $category->delete();
        // $request->session()->flash('status',"Category $category->name deleted successfully.");
        return redirect( route('categories.index'));
    }
}
