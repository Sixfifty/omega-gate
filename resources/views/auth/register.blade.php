@extends('layouts.default')
@section('content')
	<div class="container">
		<form method="POST" action="/auth/register">
		    {!! csrf_field() !!}

		    <div class="form-group">
		        <label for="username">Username</label>
		        <input type="text" name="username" value="{{ old('username') }}" class="form-control">
		    </div>

		    <div class="form-group">
		        <label for="password">Password</label>
		        <input type="password" name="password" class="form-control">
		    </div>

		    <div class="form-group">
		        <label for="password_confirmation">Confirm Password</label>
		        <input type="password" name="password_confirmation" class="form-control">
		    </div>

		    <div class="form-group">
		    	<label for="planet_name">Planet Name</label>
			    <input type="text" name="planet_name" value="{{ old('planet_name') }}" class="form-control">
		    </div>

		    <div>
		        <button type="submit" class="btn btn-primary">Register</button>
		    </div>
		</form>
	</div>
@stop