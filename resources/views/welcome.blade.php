<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'SalesPro CRM') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-gray-900 dark:text-gray-100 bg-gray-100 dark:bg-gray-900">
        <div class="min-h-screen flex flex-col justify-between">
            {{-- Navigation --}}
            <nav class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <div class="shrink-0 flex items-center">
                                <a href="{{ url('/') }}" class="flex items-center gap-2">
                                    <svg class="w-9 h-9" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M15 7C15 9.20914 13.2091 11 11 11H8" stroke="#10B981" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M9 17C9 14.7909 10.7909 13 13 13H16" stroke="#059669" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <span class="ml-2 text-xl font-semibold text-gray-800 dark:text-gray-200">{{ config('app.name', 'SalesPro CRM') }}</span>
                                </a>
                            </div>
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ms-6">
                            @if (Route::has('login'))
                                <div class="space-x-4">
                                    @auth
                                        <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                                    @else
                                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                                        @if (Route::has('register'))
                                            <a href="{{ route('register') }}" class="ms-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                                        @endif
                                    @endauth
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </nav>

            {{-- Hero Section --}}
            <header class="bg-emerald-600 text-white py-20 text-center">
                <div class="max-w-4xl mx-auto px-4">
                    <h1 class="text-5xl font-bold leading-tight">Boost Your Sales with SalesPro CRM</h1>
                    <p class="mt-4 text-xl">Manage Leads, Track Deals, and Analyze Performance with Ease.</p>
                    <div class="mt-8">
                        <a href="{{ route('register') }}" class="bg-amber-500 hover:bg-amber-600 text-white font-bold py-3 px-8 rounded-full text-lg transition duration-300 ease-in-out shadow-lg">Get Started Today</a>
                        <a href="{{ route('login') }}" class="ml-4 bg-transparent border-2 border-white hover:bg-white hover:text-emerald-600 text-white font-bold py-3 px-8 rounded-full text-lg transition duration-300 ease-in-out">Log In</a>
                    </div>
                </div>
            </header>

            {{-- Features Section --}}
            <section class="py-20 bg-gray-50 dark:bg-gray-800">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                    <h2 class="text-4xl font-bold text-gray-800 dark:text-gray-100">Powerful Features for Sales Success</h2>
                    <p class="mt-4 text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">SalesPro CRM provides everything your sales team needs to thrive.</p>
                    
                    <div class="mt-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                        {{-- Feature 1 --}}
                        <div class="bg-white dark:bg-gray-700 p-8 rounded-lg shadow-lg transform hover:scale-105 transition duration-300">
                            <div class="text-emerald-500 mb-4 flex justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800 dark:text-gray-100 mb-2">Lead Management</h3>
                            <p class="text-gray-600 dark:text-gray-300">Effortlessly capture, track, and qualify your sales leads.</p>
                        </div>
                        
                        {{-- Feature 2 --}}
                        <div class="bg-white dark:bg-gray-700 p-8 rounded-lg shadow-lg transform hover:scale-105 transition duration-300">
                            <div class="text-emerald-500 mb-4 flex justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v.01M12 6v-1m0-1V4m0 2.01M18 10a6 6 0 11-12 0 6 6 0 0112 0z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800 dark:text-gray-100 mb-2">Deal Tracking</h3>
                            <p class="text-gray-600 dark:text-gray-300">Monitor your sales pipeline and manage deals from prospecting to close.</p>
                        </div>

                        {{-- Feature 3 --}}
                        <div class="bg-white dark:bg-gray-700 p-8 rounded-lg shadow-lg transform hover:scale-105 transition duration-300">
                            <div class="text-emerald-500 mb-4 flex justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800 dark:text-gray-100 mb-2">Performance Reports</h3>
                            <p class="text-gray-600 dark:text-gray-300">Generate insightful reports to analyze sales performance and trends.</p>
                        </div>

                        {{-- Feature 4 --}}
                        <div class="bg-white dark:bg-gray-700 p-8 rounded-lg shadow-lg transform hover:scale-105 transition duration-300">
                            <div class="text-emerald-500 mb-4 flex justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800 dark:text-gray-100 mb-2">Activity Timeline</h3>
                            <p class="text-gray-600 dark:text-gray-300">Keep track of every interaction and milestone with a detailed activity log.</p>
                        </div>
                    </div>
                </div>
            </section>

            {{-- Call to Action Section --}}
            <section class="bg-emerald-500 text-white py-20 text-center">
                <div class="max-w-4xl mx-auto px-4">
                    <h2 class="text-4xl font-bold">Ready to Elevate Your Sales?</h2>
                    <p class="mt-4 text-xl">Join SalesPro CRM today and transform your sales process.</p>
                    <div class="mt-8">
                        <a href="{{ route('register') }}" class="bg-amber-400 hover:bg-amber-500 text-emerald-900 font-bold py-3 px-8 rounded-full text-lg transition duration-300 ease-in-out shadow-lg">Sign Up Now</a>
                        <a href="{{ route('login') }}" class="ml-4 bg-transparent border-2 border-white hover:bg-white hover:text-emerald-600 text-white font-bold py-3 px-8 rounded-full text-lg transition duration-300 ease-in-out">Existing User? Log In</a>
                    </div>
                </div>
            </section>

            {{-- Footer --}}
            <footer class="bg-gray-800 dark:bg-gray-900 text-gray-300 py-8 text-center">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <p>&copy; {{ date('Y') }} SalesPro CRM. All rights reserved.</p>
                </div>
            </footer>
        </div>
    </body>
</html>