<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Leads') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="flex justify-end mb-6">
                        <a href="{{ route('leads.create') }}" class="inline-flex items-center px-4 py-2 bg-emerald-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-emerald-600 active:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            {{ __('Add Lead') }}
                        </a>
                    </div>

                    @if ($message = Session::get('success'))
                        <div class="bg-emerald-50 bg-opacity-75 border-l-4 border-emerald-500 text-emerald-700 p-4 mb-4" role="alert">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-slate-500 dark:text-slate-400">
                            <thead class="text-xs text-slate-700 uppercase bg-slate-50 dark:bg-gray-700 dark:text-slate-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Name</th>
                                    <th scope="col" class="px-6 py-3">Company</th>
                                    <th scope="col" class="px-6 py-3">Status</th>
                                    <th scope="col" class="px-6 py-3">Assigned To</th>
                                    <th scope="col" class="px-6 py-3"><span class="sr-only">Actions</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($leads as $lead)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-slate-50 dark:hover:bg-gray-600">
                                        <td class="px-6 py-4 font-medium text-slate-900 dark:text-white">{{ $lead->name }}</td>
                                        <td class="px-6 py-4">{{ $lead->company->name ?? 'N/A' }}</td>
                                        <td class="px-6 py-4">
                                            <span class="px-2 py-1 font-semibold leading-tight text-xs rounded-full 
                                                @switch($lead->status)
                                                    @case('new') bg-blue-100 text-blue-800 @break
                                                    @case('contacted') bg-yellow-100 text-yellow-800 @break
                                                    @case('qualified') bg-green-100 text-green-800 @break
                                                    @case('unqualified') bg-red-100 text-red-800 @break
                                                @endswitch">
                                                {{ ucfirst($lead->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">{{ $lead->assignedTo->name ?? 'N/A' }}</td>
                                        <td class="px-6 py-4 text-right">
                                            <a href="{{ route('leads.edit', $lead) }}" class="font-medium text-emerald-600 dark:text-emerald-500 hover:underline">Edit</a>
                                            <form action="{{ route('leads.destroy', $lead) }}" method="POST" class="inline-block ml-4">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="font-medium text-red-600 dark:text-red-500 hover:underline" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td colspan="5" class="px-6 py-4 text-center">No leads found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6">
                        {{ $leads->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
