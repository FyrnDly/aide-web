<!doctype html>
<html lang="en">
<head>
	<title>@yield('title') | AIDE</title>
	@yield('pra-style')
	@include('components.style')
	@yield('add-style')
</head>

<body>
	@yield('content')

	@yield('pra-script')
	@include('components.script')
	@yield('add-script')
</body>
</html>