@extends('layouts.app')

@section('content')


<div class="container">
	<div class="row">
		<div class="col-12 col-md-12 mx-auto p-1 rounded mt-5">
			<div class="rounded-top p-2 text-dark">
				<h3>Categories</h3>
			</div>
			@if(count($categories)>0)
			<div class="container table-responsive border border-dark p-0">
				<table class="table table-bordered table-striped table-hover m-0">
					<thead class="bg-dark text-white">
						<th>
							Display Name
						</th>
						<th>
							Description
						</th>
						<th>
							Created at
						</th>
					</thead>
					<tbody>
					@foreach($categories as $category)
						<tr data-toggle="modal" data-target="#modalEditCategory{{ $category->id }}">
							<td>
								{{ $category->name }}
							</td>
							<td>
								{{ $category->description }}
							</td>
							<td>
								{{ $category->created_at }}
							</td>
						</tr>
					@endforeach
					</tbody>


				</table>
			</div>
			@else
				<h5>No Categories yet.</h5>
			@endif
				
				<button class="btn btn-outline-dark mt-4 float-right" data-toggle="modal" data-target="#modalAddCategory">Add Category</button>
			
			  </div>
			</div>


		</div>


		<!-- Modal ADD Category -->
		<div class="modal fade" id="modalAddCategory" tabindex="-1" role="dialog" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title">Add Category</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
				<form action="{{ route('categories.store') }}" method="post" class="text-center rounded m-0">
			      <div class="modal-body">
					@csrf
					<div class="form-group p-3 m-0">
						<label for="name" class="mt-3 mb-0">Category Name</label>
						<input type="text" name="name" id="name"  class="form-control mb-0 text-center" placeholder="Enter Category Name" value="" required>

						<label for="name" class="mt-3 mb-0">Description</label>
						<input type="text" name="description" id="description"  class="form-control mb-0 text-center" placeholder="Enter Description" value="">

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

		<!-- Modal EDIT Category -->
		@foreach($categories as $category)
			<div class="modal fade" id="modalEditCategory{{ $category->id }}" tabindex="-1" role="dialog" aria-hidden="true">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title">Edit Category</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
					<form action="{{ route("categories.update",['category'=> $category->id]) }}" method="post"  enctype="multipart/form-data" class="text-center rounded m-0">
				      	@method('PUT')
						@csrf
						<div class="form-group p-3 m-0">
							<label for="name" class="mt-3 mb-0">Category Name</label>
							<input type="text" name="name" id="name"  class="form-control mb-0 text-center" placeholder="Enter Category Name" value="{{ $category->name }}" <?php echo ( $category->name == "admin" || $category->name == "user") ? "disabled" : "required"; ?>>

							<label for="name" class="mt-3 mb-0">Description</label>
							<input type="text" name="description" id="description"  class="form-control mb-0 text-center" placeholder="Enter Description" value="{{ $category->description }}">

						</div>	
				      {{-- </div> --}}
				      {{-- <div class="modal-footer"> --}}
				        <button type="submit" class="btn btn-outline-dark float-right">Save</button>
				        <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Cancel</button>

					</form>
					<form action="{{ route("categories.destroy",['category'=> $category->id]) }}" method="post"  enctype="multipart/form-data" class="text-center rounded m-0">
				      	@method('DELETE')
						@csrf
				        <button type="submit" class="btn btn-outline-dark float-left <?php echo ( $category->name == "admin" || $category->name == "user") ? "d-none" : ""; ?>">Delete</button>
				    </form>
			      </div>
			    </div>
			  </div>
			</div>
		@endforeach






@endsection