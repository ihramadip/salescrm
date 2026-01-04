<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Sales Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- KPI Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                {{-- Total Revenue Card --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg border-t-4 border-emerald-500">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-emerald-100 dark:bg-emerald-900 rounded-md p-3">
                                <svg class="h-6 w-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v.01M12 6v-1m0-1V4m0 2.01M18 10a6 6 0 11-12 0 6 6 0 0112 0z"></path></svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Total Revenue</dt>
                                    <dd>
                                        <div class="text-lg font-bold text-gray-900 dark:text-gray-100">${{ number_format($revenueThisMonth, 2) }}</div>
                                        <div class="text-sm font-medium {{ $revenueDiff >= 0 ? 'text-emerald-500' : 'text-red-500' }}">
                                            {{ $revenueDiff >= 0 ? '+' : '' }}{{ number_format($revenueDiff, 1) }}%
                                        </div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- New Leads Card --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg border-t-4 border-amber-500">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-amber-100 dark:bg-amber-900 rounded-md p-3">
                                <svg class="h-6 w-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">New Leads</dt>
                                    <dd>
                                        <div class="text-lg font-bold text-gray-900 dark:text-gray-100">{{ number_format($leadsThisMonth) }}</div>
                                        <div class="text-sm font-medium {{ $leadsDiff >= 0 ? 'text-emerald-500' : 'text-red-500' }}">
                                            {{ $leadsDiff >= 0 ? '+' : '' }}{{ number_format($leadsDiff, 1) }}%
                                        </div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Deals Won Card --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg border-t-4 border-emerald-500">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-emerald-100 dark:bg-emerald-900 rounded-md p-3">
                                <svg class="h-6 w-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.085a2 2 0 00-1.74.956L5.5 10m9 0H3.25"></path></svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Deals Won</dt>
                                    <dd>
                                        <div class="text-lg font-bold text-gray-900 dark:text-gray-100">{{ number_format($dealsWonThisMonth) }}</div>
                                        <div class="text-sm font-medium {{ $dealsWonDiff >= 0 ? 'text-emerald-500' : 'text-red-500' }}">
                                            {{ $dealsWonDiff >= 0 ? '+' : '' }}{{ number_format($dealsWonDiff, 1) }}%
                                        </div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Conversion Rate Card --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg border-t-4 border-amber-400">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-amber-100 dark:bg-amber-900 rounded-md p-3">
                                <svg class="h-6 w-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Conversion Rate</dt>
                                    <dd>
                                        <div class="text-lg font-bold text-gray-900 dark:text-gray-100">{{ number_format($conversionRateThisMonth, 1) }}%</div>
                                        <div class="text-sm font-medium {{ $conversionRateDiff >= 0 ? 'text-emerald-500' : 'text-red-500' }}">
                                            {{ $conversionRateDiff >= 0 ? '+' : '' }}{{ number_format($conversionRateDiff, 1) }}%
                                        </div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Charts Section --}}
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-6 mb-8">
                {{-- Revenue vs Target Chart --}}
                <div class="lg:col-span-3 bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Revenue vs Target (Last 12 Months)</h3>
                    <div class="relative h-96"> {{-- Added a div with fixed height --}}
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>

                {{-- Sales Pipeline Chart --}}
                <div class="lg:col-span-2 bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Sales Pipeline</h3>
                     <div class="space-y-4 mt-4">
                        <div class="flex justify-between items-center">
                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Open Deals</span>
                            <span class="text-lg font-bold text-gray-900 dark:text-gray-100">{{ number_format($openDeals) }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Win Rate</span>
                            <span class="text-lg font-bold text-gray-900 dark:text-gray-100">{{ number_format($winRate, 1) }}%</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Avg. Deal Size</span>
                            <span class="text-lg font-bold text-gray-900 dark:text-gray-100">${{ number_format($avgDealSize, 0) }}</span>
                        </div>
                    </div>
                    <div class="relative h-96"> {{-- Added a div with fixed height --}}
                        <canvas id="pipelineChart" class="mt-4"></canvas>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- Chart.js Script --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Dashboard script loaded.');

            // --- DEBUGGING LOGS ---
            const revenueCanvas = document.getElementById('revenueChart');
            const pipelineCanvas = document.getElementById('pipelineChart');
            console.log('Revenue Canvas Element:', revenueCanvas);
            console.log('Pipeline Canvas Element:', pipelineCanvas);

            const chartLabels = @json($chartLabels);
            const actualRevenueData = @json($actualRevenueData);
            const pipelineStages = @json($pipelineStages);
            const pipelineData = @json($pipelineData);

            console.log('Chart Labels:', chartLabels);
            console.log('Actual Revenue Data:', actualRevenueData);
            console.log('Pipeline Stages:', pipelineStages);
            console.log('Pipeline Data:', pipelineData);
            // --- END DEBUGGING LOGS ---
            
            if (!revenueCanvas || !pipelineCanvas) {
                console.error('Chart canvas element not found!');
                return;
            }

            // Common Chart Options
            const isDarkMode = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
            const gridColor = isDarkMode ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.1)';
            const textColor = isDarkMode ? '#d1d5db' : '#374151'; // gray-300 or gray-700

            // Revenue vs Target Chart
            const revenueCtx = revenueCanvas.getContext('2d');
            new Chart(revenueCtx, {
                type: 'line',
                data: {
                    labels: chartLabels,
                    datasets: [{
                        label: 'Actual Revenue',
                        data: actualRevenueData,
                        borderColor: '#10B981', // emerald-500
                        backgroundColor: 'rgba(16, 185, 129, 0.2)',
                        fill: true,
                        tension: 0.4
                    }, {
                        label: 'Target Revenue',
                        data: @json($targetRevenueData),
                        borderColor: '#F59E0B', // amber-500 (gold/yellow)
                        backgroundColor: 'transparent',
                        borderDash: [5, 5],
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: { color: textColor }
                        },
                    },
                    scales: {
                        x: {
                            ticks: { color: textColor },
                            grid: { color: gridColor }
                        },
                        y: {
                            ticks: { color: textColor },
                            grid: { color: gridColor },
                            beginAtZero: true
                        }
                    }
                }
            });

            // Sales Pipeline Chart
            const pipelineCtx = pipelineCanvas.getContext('2d');
            const pipelineColors = {
                'qualification': '#A7F3D0', // emerald-200
                'proposal': '#34D399',    // emerald-400
                'negotiation': '#059669', // emerald-700
                'won': '#047857',         // emerald-800
                'lost': '#64748B'        // slate-500 (changed from red)
            };
            const backgroundColors = pipelineStages.map(stage => pipelineColors[stage] || '#6B7280');
            
            new Chart(pipelineCtx, {
                type: 'bar', // Changed from 'doughnut'
                data: {
                    labels: pipelineStages.map(stage => stage.charAt(0).toUpperCase() + stage.slice(1)),
                    datasets: [{
                        label: 'Number of Deals',
                        data: pipelineStages.map(stage => pipelineData[stage] || 0),
                        backgroundColor: backgroundColors,
                        borderColor: backgroundColors.map(color => color), // Use backgroundColors for border too
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false, // Don't need legend for single dataset bar chart
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false,
                        }
                    },
                    scales: {
                        x: {
                            ticks: { color: textColor },
                            grid: { color: gridColor }
                        },
                        y: {
                            ticks: { color: textColor },
                            grid: { color: gridColor },
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>