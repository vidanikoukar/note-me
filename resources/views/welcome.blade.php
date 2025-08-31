<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - Welcome</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex flex-col">
    <!-- Header -->
    @include('layouts.header')

    <!-- Main Content -->
    <main class="flex-grow container mx-auto p-4">
        <h1 class="text-3xl font-bold text-center mb-4">خوش آمدید به Blog</h1>
        <p class="text-center">این یک سایت نمونه ساخته شده با لاراول است.</p>
    </main>

    <!-- Footer -->
    @include('layouts.footer')
</body>
</html>