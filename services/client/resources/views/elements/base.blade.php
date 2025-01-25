<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('elements.head')
    </head>
    <body class="font-sans antialiased">
        <div class="w-full min-h-screen flex flex-col">
            <nav class="bg-gray-800 text-white p-4 fixed top-0 w-full z-10">
                @include('elements.navigation')
            </nav>
            
            <header class="bg-white shadow-md mt-20 items-center">
                <div class="container mx-auto py-2 px-4 flex items-center justify-center">
                    @yield('title')
                </div>
            </header>
            
            <main class="flex-grow container mx-auto px-4 py-8">
                @yield('content')
            </main>
            
            <footer class="bg-gray-100 border-t">
                <div class="container mx-auto p-4 text-center text-gray-600">
                    @include('elements.footer')
                </div>
            </footer>
        </div>
        <script type="module">
            @stack('scripts')
        </script>
    </body>
</html>
