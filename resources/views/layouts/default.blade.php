<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta id="token" name="token" value="<?= csrf_token() ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
		<link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.5/slate/bootstrap.min.css" rel="stylesheet">	
		<link rel="stylesheet" href="/style.css">
		<link rel="stylesheet" href="/jquery-ui-1.11.4.custom/jquery-ui.css">
		<script src="/jquery-ui-1.11.4.custom/external/jquery/jquery.js"></script>
		<script src="/jquery-ui-1.11.4.custom/jquery-ui.js"></script>
		
		<title>Omega Gate : @yield('page_title', 'Space simulator')</title>
	</head>
	<body>

		<nav class="navbar navbar-default">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="/">Omega Gate</a>
			</div>
			<div class="navbar-collapse collapse navbar-responsive-collapse">

				<ul class="nav navbar-nav navbar-right">
				<li class="headerSummary">
					<span id="userMetal"></span>
					<span id="userEnergy"></span>
					<span id="userPlanet"></span>
				</li>
					@if (Auth::check())
					<li><a href="{{ route('auth.logout') }}"><i class="fa fa-sign-out fa-fw"></i> Log out</a></li>
					@else
					<li><a href="{{ route('auth.login') }}"><i class="fa fa-sign-in fa-fw"></i> Log in</a></li>
					@endif
				</ul>

			</div>
		</nav>

		@yield('content')
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	</body>
</html>
