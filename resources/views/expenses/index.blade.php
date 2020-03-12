@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-12 col-md-12 mx-auto p-1 rounded mt-5">
            <div class="rounded-top p-2 text-dark">
                <h3>Expenses</h3>
            </div>
            @if(count($expenses)>0)
            <div class="container table-responsive border border-dark p-0">
                <table class="table table-bordered table-striped table-hover m-0">
                    <thead class="bg-dark text-white">
                        <th>
                            Expense Category
                        </th>
                        <th>
                            Amount
                        </th>
                        <th>
                            Entry Date
                        </th>
                        <th>
                            Created at
                        </th>
                    </thead>
                    <tbody>
                    @foreach($expenses as $expense)
                        <tr data-toggle="modal" data-target="#modalEditExpense{{ $expense->id }}">
                            <td>
                                {{ $expense->category_id }}
                            </td>
                            <td>
                                {{ $expense->amount }}
                            </td>
                            <td>
                                {{ $expense->entrydate }}
                            </td>
                            <td>
                                {{ $expense->created_at }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>


                </table>
            </div>
            @else
                <h3>No Expenses yet.</h3>
            @endif
                
                <button class="btn btn-outline-dark mt-4 float-right" data-toggle="modal" data-target="#modalAddExpense">Add Expense</button>
            
              </div>
            </div>


        </div>


        <!-- Modal ADD Expense -->
        <div class="modal fade" id="modalAddExpense" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Add Expense</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
                <form action="{{ route('expenses.store') }}" method="post" class="text-center rounded m-0">
                  <div class="modal-body">
                    @csrf
                    <div class="form-group p-3 m-0">
                        <label for="category" class="mt-3 mb-0">Expense Category</label>
                        <input type="text" name="category" id="category"  class="form-control mb-0 text-center" placeholder="Enter Expense Category" value="" required>

                        <label for="amount" class="mt-3 mb-0">Amount</label>
                        <input type="number" name="amount" id="amount"  class="form-control mb-0 text-center" placeholder="Enter Amount" value="">

                        <label for="entrydate" class="mt-3 mb-0">Entry Date</label>
                        <input type="date" name="entrydate" id="entrydate"  class="form-control mb-0 text-center" placeholder="Enter Amount" value="">


                    </div>  
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-outline-dark">Save</button>
                  </div>
                </form>
            </div>
          </div>
        </div>

        <!-- Modal EDIT Expense -->
        @foreach($expenses as $expense)
            <div class="modal fade" id="modalEditExpense{{ $expense->id }}" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Edit Expense</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form action="{{ route("expenses.update",['expense'=> $expense->id]) }}" method="post"  enctype="multipart/form-data" class="text-center rounded m-0">
                        @method('PUT')
                        @csrf
                        <div class="form-group p-3 m-0">
                            
                            <label for="category" class="mt-3 mb-0">Expense Category</label>
                            <input type="text" name="category" id="category"  class="form-control mb-0 text-center" placeholder="Enter Expense Category" value="{{ $expense->category_id }}" required>

                            <label for="amount" class="mt-3 mb-0">Amount</label>
                            <input type="number" name="amount" id="amount"  class="form-control mb-0 text-center" placeholder="Enter Amount" value="{{ $expense->amount }}">

                            <label for="entrydate" class="mt-3 mb-0">Entry Date</label>
                            <input type="date" name="entrydate" id="entrydate"  class="form-control mb-0 text-center" placeholder="Enter Amount" value="{{ $expense->entrydate }}">

                        </div>  
                      {{-- </div> --}}
                      {{-- <div class="modal-footer"> --}}
                        <button type="submit" class="btn btn-outline-dark float-right">Save</button>
                        <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Cancel</button>

                    </form>
                    <form action="{{ route("expenses.destroy",['expense'=> $expense->id]) }}" method="post"  enctype="multipart/form-data" class="text-center rounded m-0">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-outline-dark float-left <?php echo ( $expense->name == "admin" || $expense->name == "user") ? "d-none" : ""; ?>">Delete</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
        @endforeach






@endsection