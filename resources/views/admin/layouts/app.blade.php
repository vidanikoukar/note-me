<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'پنل ادمین')</title>
    
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    
    <!-- Persian Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Vazir:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Custom Styles -->
    <style>
        * {
            font-family: 'Vazir', sans-serif;
        }
        .dir-rtl {
            direction: rtl;
            text-align: right;
        }
        .space-x-reverse > * + * {
            margin-right: 0.5rem;
            margin-left: 0;
        }
        .hover-transition {
            transition: all 0.3s ease;
        }
        .sidebar-link {
            transition: all 0.2s ease;
        }
        .sidebar-link:hover {
            transform: translateX(-2px);
        }
        .card-shadow {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%);
        }
    </style>
    
    @yield('additional-styles')
</head>
<body class="bg-gray-50 dir-rtl">
    <!-- Top Navigation Bar -->
    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <h1 class="text-2xl font-bold text-gray-800">سیستم مدیریت</h1>
                    </div>
                </div>
                
                <div class="flex items-center space-x-4 space-x-reverse">
                    <!-- User Profile Dropdown -->
                    <div class="relative">
                        <button class="flex items-center text-sm text-gray-700 hover:text-gray-900 focus:outline-none">
                            <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center text-white font-medium">
                                {{ substr(auth()->user()->name ?? 'ادمین', 0, 1) }}
                            </div>
                            <span class="mr-2">{{ auth()->user()->name ?? 'ادمین' }}</span>
                            <svg class="mr-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                    
                    <!-- Logout Button -->
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-sm text-red-600 hover:text-red-800 font-medium">
                            خروج
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="min-h-screen">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 mt-12">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="text-center text-gray-500 text-sm">
                © {{ date('Y') }} سیستم مدیریت. تمامی حقوق محفوظ است.
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script>
        // Confirmation dialogs
        function confirmDelete(message = 'آیا مطمئن هستید؟') {
            return confirm(message);
        }
        
        // Auto-hide flash messages
        document.addEventListener('DOMContentLoaded', function() {
            const flashMessages = document.querySelectorAll('[class*="bg-green-100"], [class*="bg-red-100"], [class*="bg-yellow-100"]');
            flashMessages.forEach(function(message) {
                setTimeout(function() {
                    message.style.transition = 'opacity 0.5s ease';
                    message.style.opacity = '0';
                    setTimeout(function() {
                        message.remove();
                    }, 500);
                }, 5000);
            });
        });
        
        // Form validation helpers
        function validateForm(formSelector) {
            const form = document.querySelector(formSelector);
            if (!form) return true;
            
            const requiredFields = form.querySelectorAll('[required]');
            let isValid = true;
            
            requiredFields.forEach(function(field) {
                if (!field.value.trim()) {
                    field.classList.add('border-red-500');
                    isValid = false;
                } else {
                    field.classList.remove('border-red-500');
                }
            });
            
            return isValid;
        }
    </script>
    
    @yield('additional-scripts')
</body>
</html>