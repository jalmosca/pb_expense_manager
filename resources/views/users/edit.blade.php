@extends('layouts.app')

@section('content')


<div class="container">
	<div class="row">
		<div class="col-12 col-md-12 mx-auto p-1 rounded mt-5">
			<div class="rounded-top p-2 text-dark">
				<h3>{{ Auth::user()->name }} Change Password</h3>
			</div>
				<form action="{{ route('users.update',['user'=> Auth::user()->id]) }}" method="post" class="text-center rounded m-0 w-50 mx-auto">
				      	@method('PUT')
						@csrf
						<div class="form-group p-3 m-0">
							<label for="password" class="mt-3 mb-0">New Password</label>
							<input type="password" name="password" id="password"  class="form-control mb-0 text-center" placeholder="Enter New Password" value="" required>
						</div>
						<div class="form-group p-3 m-0">
							<label for="password" class="mt-3 mb-0">Confirm New Password</label>
							<input type="password" name="cpassword" id="cpassword"  class="form-control mb-0 text-center" placeholder="Confirm New Password" value="" required>
						</div>
				        <button type="submit" class="btn btn-outline-dark float-right mx-3">Save New Password</button>
				        <a class="btn btn-secondary float-right" href="{{ route('home') }}">Cancel</a>
				</form>
			</div>


		</div>






@endsection