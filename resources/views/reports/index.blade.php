<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Reports & Analytics') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium">Available Reports</h3>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        Select a report to view and generate.
                    </p>

                    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        
                        {{-- Revenue Report Card --}}
                        <div class="bg-slate-50 dark:bg-gray-700 p-6 rounded-lg shadow">
                            <div class="flex items-start gap-4">
                                <div class="flex-shrink-0 bg-emerald-100 dark:bg-emerald-900 p-3 rounded-lg">
                                    <svg class="h-6 w-6 text-emerald-600 dark:text-emerald-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h4 class="text-base font-semibold text-gray-800 dark:text-gray-200">Revenue Report</h4>
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Track total revenue over a specific period.</p>
                                    <a href="{{ route('reports.revenue') }}" class="mt-3 inline-block text-sm font-medium text-emerald-600 hover:text-emerald-500">
                                        Generate Report &rarr;
                                    </a>
                                </div>
                            </div>
                        </div>

                        {{-- Add other report cards here in the future --}}
                        <div class="bg-slate-50 dark:bg-gray-700 p-6 rounded-lg shadow opacity-50">
                            <div class="flex items-start gap-4">
                                <div class="flex-shrink-0 bg-slate-100 dark:bg-slate-900 p-3 rounded-lg">
                                    <svg class="h-6 w-6 text-slate-600 dark:text-slate-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h4 class="text-base font-semibold text-gray-800 dark:text-gray-200">Sales Performance</h4>
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Analyze performance by sales representative.</p>
                                     <p class="mt-3 text-sm font-medium text-slate-500">
                                        Coming Soon
                                    </p>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
