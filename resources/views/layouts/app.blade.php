<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Your App Name')</title>
</head>

<body>
    <header>
        <!-- Add your header content -->
    </header>

    <nav>
        <!-- Add your navigation menu -->
    </nav>

    <main>
        @yield('content')
    </main>

    <footer>
        <!-- Add your footer content -->
    </footer>
</body>

</html>
