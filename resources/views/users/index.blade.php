@extends('layouts.app')

@section('content')


<div class="container">
	<div class="row">
		<div class="col-12 col-md-12 mx-auto p-1 rounded mt-5">
			<div class="rounded-top p-2 text-dark">
				<h3>Users</h3>
			</div>
			@if(count($users)>0)
			<div class="container table-responsive border border-dark p-0">
				<table class="table table-bordered table-striped table-hover m-0">
					<thead class="bg-dark text-white">
						<th>
							Name
						</th>
						<th>
							Email Address
						</th>
						<th>
							Role
						</th>
						<th>
							Created at
						</th>
					</thead>
					<tbody>
					@foreach($users as $user)
						<tr data-toggle="modal" data-target="#modalEditUser{{ $user->id }}">
							<td>
								{{ $user->name }}
							</td>
							<td>
								{{ $user->email }}
							</td>
							<td>
								@foreach($roles as $role)
									<?php 
										if($role->id == $user->role_id){
											echo $role->name;
										}
									?>
								@endforeach
							</td>
							<td>
								{{ $user->created_at }}
							</td>
						</tr>
					@endforeach
					</tbody>


				</table>
			</div>
			@else
				<h5>No Users yet.</h5>
			@endif
				
				<button class="btn btn-outline-dark mt-4 float-right" data-toggle="modal" data-target="#modalAddUser">Add User</button>
			
			  </div>
			</div>


		</div>


		<!-- Modal ADD USER -->
		<div class="modal fade" id="modalAddUser" tabindex="-1" role="dialog" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title">Add User</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
				<form action="{{ route('users.store') }}" method="post" class="text-center rounded m-0">
			      <div class="modal-body">
					@csrf
					<div class="form-group p-3 m-0">
						<label for="name" class="mt-3 mb-0">Name</label>
						<input type="text" name="name" id="name"  class="form-control mb-0 text-center" placeholder="Enter USER Name" value="" required>

						<label for="name" class="mt-3 mb-0">Email Address</label>
						<input type="email" name="email" id="email"  class="form-control mb-0 text-center" placeholder="Enter Email Address" value="" required>

						<label for="name" class="mt-3 mb-0">Role</label>

						<select name="role" id="role" class="form-control" required>
									<option value="" selected disabled>Select Role</option>
								@foreach($roles as $role)
									<option value="{{ $role->id }}">{{ $role->name }}</option>
								@endforeach
						</select>
						<div class="alert alert-warning mt-5">
							Remind new users to change initial password. <br/>
							default initial password: <br/>
							for new admin account : admin1234 <br/>
							for new non-admin account : 12345678
						</div>
					
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

		<!-- Modal EDIT USER -->
		@foreach($users as $user)
			<div class="modal fade" id="modalEditUser{{ $user->id }}" tabindex="-1" role="dialog" aria-hidden="true">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title">Edit User</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
					<form action="{{ route("users.update",['user'=> $user->id]) }}" method="post"  enctype="multipart/form-data" class="text-center rounded m-0">
				      	@method('PUT')
						@csrf
						<div class="form-group p-3 m-0">
							<label for="name" class="mt-3 mb-0">Name</label>
							<input type="text" name="name" id="name"  class="form-control mb-0 text-center" placeholder="Enter USER Name" value="{{ $user->name }}" required>

							<label for="name" class="mt-3 mb-0">Email Address</label>
							<input type="email" name="email" id="email"  class="form-control mb-0 text-center" placeholder="Enter Email Address" value="{{ $user->email }}" required>

							<label for="role" class="mt-3 mb-0">Role</label>
							<select name="role" id="role" class="form-control" required>
									@foreach($roles as $role)
										<option value="{{ $role->id }}" <?php echo ($role->id == $user->role_id) ? "selected" : "" ?>>{{ $role->name }}</option>
									@endforeach
							</select>

						</div>	
				      {{-- </div> --}}
				      {{-- <div class="modal-footer"> --}}
				        <button type="submit" class="btn btn-outline-dark float-right">Save</button>
				        <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Cancel</button>

					</form>
					<form action="{{ route("users.destroy",['user'=> $user->id]) }}" method="post"  enctype="multipart/form-data" class="text-center rounded m-0">
				      	@method('DELETE')
						@csrf
				        <button type="submit" class="btn btn-outline-dark float-left <?php echo ( $user->name == "admin" || $user->name == "user") ? "d-none" : ""; ?>">Delete</button>
				    </form>
			      </div>
			    </div>
			  </div>
			</div>
		@endforeach






@endsection