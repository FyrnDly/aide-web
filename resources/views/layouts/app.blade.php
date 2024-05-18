<!doctype html>
<html lang="en">
<head>
	<title>@yield('title') | AIDE</title>
	@yield('pra-style')
	@include('components.style')
	@yield('add-style')
</head>

<body>
	<!-- Navbar -->
	@include('components.navbar')

	@yield('pra-main')
	<!-- Main Content -->
	<main class="container">
		@yield('main')
	</main>

	@include('components.footer')

	@yield('pra-script')
	@include('components.script')
	@yield('add-script')
</body>
</html>