<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>Database - @yield('title')</title>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" />
    </head>
    <body>
        <header>
            <h1>@yield('title')</h1>
            <nav>
                <a href="{{ route('product-list') }} " style="text-decoration: none;">Product</a>
                <a href="{{ route('category-list') }} " style="text-decoration: none;">Category</a>
                <a href="{{ route('shop-list') }} " style="text-decoration: none;">Shop</a>
            </nav> <br />
        </header>
        <main>
            @yield('content')
        </main> <br /><br /><br /><br /><br /><br />
        <footer>
            &#xA9; Copyright Week-07, 2020 Terapat's Database.
        </footer>
    </body>
</html>