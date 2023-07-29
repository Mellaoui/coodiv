<!DOCTYPE html>
<html class="bg-white" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
        <script src="https://cdn.tiny.cloud/1/tsokb1pnqo5foa9euhq4byx7m6tlapfah978g1gapy6xvp1b/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>    
       
    </head>
    <body class="w-full font-sans antialiased bg-gray-50">
        @inertia
    </body>
</html>
