@extends('layouts.default')
@section('content')
	<div class="container">
	
		<form method="POST" action="/auth/login">
		    {!! csrf_field() !!}

		    <div class="form-group">
		        <label for="username">Username</label>
		        <input type="text" name="username" value="{{ old('username') }}" class="form-control">
		    </div>

		    <div class="form-group">
		        <label for="password">Password</label>
		        <input type="password" name="password" id="password" class="form-control">
		    </div>

		    <div class="checkbox">
		    	<label>
		    		<input type="checkbox" name="remember"> Remember Me
	    		</label>
		    </div>

		    <div>
		        <button class="btn btn-primary" type="submit">Login</button>
		    </div>
		</form>
	</div>
@stop