@extends('layouts.app')

@section('content')


<div class="container">
	<div class="row">
		<div class="col-12 col-md-12 mx-auto p-1 rounded mt-5">
			<div class="rounded-top p-2 text-dark">
				<h3>Roles</h3>
			</div>
			@if(count($roles)>0)
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
					@foreach($roles as $role)
						<tr data-toggle="modal" data-target="#modalEditRole{{ $role->id }}">
							<td>
								{{ $role->name }}
							</td>
							<td>
								{{ $role->description }}
							</td>
							<td>
								{{ $role->created_at }}
							</td>
						</tr>
					@endforeach
					</tbody>


				</table>
			</div>
			@else
				<h5>No roles yet.</h5>
			@endif
				
				<button class="btn btn-outline-dark mt-4 float-right" data-toggle="modal" data-target="#modalAddRole">Add Role</button>
			
			  </div>
			</div>


		</div>


		<!-- Modal ADD ROLE -->
		<div class="modal fade" id="modalAddRole" tabindex="-1" role="dialog" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title">Add Role</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
				<form action="{{ route('roles.store') }}" method="post" class="text-center rounded m-0">
			      <div class="modal-body">
					@csrf
					<div class="form-group p-3 m-0">
						<label for="name" class="mt-3 mb-0">Role Name</label>
						<input type="text" name="name" id="name"  class="form-control mb-0 text-center" placeholder="Enter Role Name" value="" required>

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

		<!-- Modal EDIT ROLE -->
		@foreach($roles as $role)
			<div class="modal fade" id="modalEditRole{{ $role->id }}" tabindex="-1" role="dialog" aria-hidden="true">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title">Edit Role</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
					<form action="{{ route("roles.update",['role'=> $role->id]) }}" method="post"  enctype="multipart/form-data" class="text-center rounded m-0">
				      	@method('PUT')
						@csrf
						<div class="form-group p-3 m-0">
							<label for="name" class="mt-3 mb-0">Role Name</label>
							<input type="text" name="name" id="name"  class="form-control mb-0 text-center" placeholder="Enter Role Name" value="{{ $role->name }}" <?php echo ( $role->name == "admin" || $role->name == "user") ? "disabled" : "required"; ?>>

							<label for="name" class="mt-3 mb-0">Description</label>
							<input type="text" name="description" id="description"  class="form-control mb-0 text-center" placeholder="Enter Description" value="{{ $role->description }}">

						</div>	
				      {{-- </div> --}}
				      {{-- <div class="modal-footer"> --}}
				        <button type="submit" class="btn btn-outline-dark float-right">Save</button>
				        <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Cancel</button>

					</form>
					<form action="{{ route("roles.destroy",['role'=> $role->id]) }}" method="post"  enctype="multipart/form-data" class="text-center rounded m-0">
				      	@method('DELETE')
						@csrf
				        <button type="submit" class="btn btn-outline-dark float-left <?php echo ( $role->name == "admin" || $role->name == "user") ? "d-none" : ""; ?>">Delete</button>
				    </form>
			      </div>
			    </div>
			  </div>
			</div>
		@endforeach






@endsection