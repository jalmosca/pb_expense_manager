<?php

namespace App\Http\Controllers;

use App\Expense;
use App\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $expenses = Expense::all();
        $categories = Category::all();

        foreach ($categories as $category) {

            foreach ($expenses as $expense) {
                if($category->id == $expense->category_id)
                    $category->total += $expense->amount;
                }
            }

        return view('home')->with('expenses',$expenses)->with('categories',$categories);
    }
}
