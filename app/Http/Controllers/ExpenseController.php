<?php

namespace App\Http\Controllers;

use App\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $this->authorize('viewAny',$expense);
        $expenses = Expense::all();
        return view('expenses.index')->with('expenses',$expenses);
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
            'category' => 'required',
            'amount' => 'required|max:999999999',
            'entrydate' => 'string|required'
        ]);
        // $name = $request->input('category');

        $expense = new Expense;
        $expense->category_id = $request->input('category');
        $expense->amount = $request->input('amount');
        $expense->entrydate = $request->input('entrydate');
        $expense->save();
        return redirect( route('expenses.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expense $expense)
    {
        $request->validate([
            'category' => 'required',
            'amount' => 'required|max:999999999',
            'entrydate' => 'string|required'
        ]);
        // $name = $request->input('category');

        $expense->category_id = $request->input('category');
        $expense->amount = $request->input('amount');
        $expense->entrydate = $request->input('entrydate');
        $expense->save();
        return redirect( route('expenses.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,Expense $expense)
    {
        //
        $expense->delete();
        // $request->session()->flash('status',"Expense $expense->category_id deleted successfully.");
        return redirect( route('expenses.index'));
    }
}
