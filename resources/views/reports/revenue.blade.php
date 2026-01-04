<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Revenue Report') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Form for date range --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('reports.revenue') }}" method="GET">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <x-input-label for="start_date" :value="__('Start Date')" />
                                <x-text-input id="start_date" name="start_date" type="date" class="mt-1 block w-full" :value="$startDate" required />
                            </div>
                            <div>
                                <x-input-label for="end_date" :value="__('End Date')" />
                                <x-text-input id="end_date" name="end_date" type="date" class="mt-1 block w-full" :value="$endDate" required />
                            </div>
                            <div class="flex items-end">
                                <x-primary-button>{{ __('Generate') }}</x-primary-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Report Results --}}
            @if(isset($revenues))
                <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="flex justify-between items-center">
                            <div>
                                <h3 class="text-lg font-medium">Report Results</h3>
                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                    Showing revenues from {{ \Carbon\Carbon::parse($startDate)->format('M d, Y') }} to {{ \Carbon\Carbon::parse($endDate)->format('M d, Y') }}.
                                </p>
                            </div>
                            <a href="{{ route('reports.revenue.export', ['start_date' => $startDate, 'end_date' => $endDate]) }}" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150">
                                {{ __('Export to Excel') }}
                            </a>
                        </div>
                        
                        <div class="mt-4 bg-emerald-50 dark:bg-emerald-900 p-4 rounded-lg">
                            <p class="text-sm text-emerald-700 dark:text-emerald-300">Total Revenue</p>
                            <p class="text-2xl font-bold text-emerald-800 dark:text-emerald-200">${{ number_format($totalRevenue, 2) }}</p>
                        </div>

                        <div class="mt-6 relative overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left text-slate-500 dark:text-slate-400">
                                <thead class="text-xs text-slate-700 uppercase bg-slate-50 dark:bg-gray-700 dark:text-slate-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">Date</th>
                                        <th scope="col" class="px-6 py-3">Deal Title</th>
                                        <th scope="col" class="px-6 py-3 text-right">Amount</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                    @forelse ($revenues as $revenue)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-slate-50 dark:hover:bg-gray-600">
                                            <td class="px-6 py-4">{{ \Carbon\Carbon::parse($revenue->revenue_date)->format('M d, Y') }}</td>
                                            <td class="px-6 py-4 font-medium text-slate-900 dark:text-white">
                                                <a href="{{ route('deals.edit', $revenue->deal) }}" class="hover:underline text-emerald-600">{{ $revenue->deal->title ?? 'N/A' }}</a>
                                            </td>
                                            <td class="px-6 py-4 text-right">${{ number_format($revenue->amount, 2) }}</td>
                                        </tr>
                                    @empty
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <td colspan="3" class="px-6 py-4 text-center">No revenues found for this period.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @else
                <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100 text-center">
                        <p class="text-gray-500 dark:text-gray-400">Please select a date range and click "Generate" to view the report.</p>
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
