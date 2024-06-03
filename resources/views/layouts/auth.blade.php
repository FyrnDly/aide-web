<!doctype html>
<html lang="en">
<head>
    <title>@yield('title') | AIDE</title>
    @yield('pra-style')
    @include('components.style')
    @yield('add-style')
</head>

<body>
    <main class="d-flex justify-content-center w-100" style="height:100vh;">
        <section class="guest-form align-self-center">
            @yield('content')
        </section>
    </main>

    @yield('pra-script')
    @include('components.script')
    @yield('add-script')
</body>
</html>

