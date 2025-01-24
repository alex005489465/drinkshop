<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('elements.head')
    </head>
    <body class="font-sans antialiased">
        <div class="w-full min-h-screen flex flex-col">
            <nav class="bg-gray-800 text-white p-4 fixed top-0 w-full">
                @include('elements.navigation')
            </nav>
            
            <header class="bg-white shadow-md mt-20">
                <div class="container mx-auto py-6 px-4 flex items-center">
                    @yield('title')
                </div>
            </header>
            
            <main class="flex-grow container mx-auto px-4 py-8">
                @yield('content')
            </main>
            
            <footer class="bg-gray-100 border-t">
                <div class="container mx-auto p-4 text-center text-gray-600">
                    @yield('bottom')
                </div>
            </footer>
        </div>
        <script type="module">
            @yield('scripts')
        </script>
    </body>
</html>
