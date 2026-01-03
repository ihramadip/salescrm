<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tasks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="flex justify-end mb-6">
                        <a href="{{ route('tasks.create') }}" class="inline-flex items-center px-4 py-2 bg-emerald-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-emerald-600 active:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            {{ __('Add Task') }}
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
                                    <th scope="col" class="px-6 py-3">Title</th>
                                    <th scope="col" class="px-6 py-3">Due Date</th>
                                    <th scope="col" class="px-6 py-3">Priority</th>
                                    <th scope="col" class="px-6 py-3">Status</th>
                                    <th scope="col" class="px-6 py-3">Assigned To</th>
                                    <th scope="col" class="px-6 py-3">Related To</th>
                                    <th scope="col" class="px-6 py-3"><span class="sr-only">Actions</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($tasks as $task)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-slate-50 dark:hover:bg-gray-600">
                                        <td class="px-6 py-4 font-medium text-slate-900 dark:text-white">{{ $task->title }}</td>
                                        <td class="px-6 py-4">{{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('M d, Y') : 'N/A' }}</td>
                                        <td class="px-6 py-4">
                                            <span class="px-2 py-1 font-semibold leading-tight text-xs rounded-full 
                                                @switch($task->priority)
                                                    @case('low') bg-gray-100 text-gray-800 @break
                                                    @case('medium') bg-yellow-100 text-yellow-800 @break
                                                    @case('high') bg-red-100 text-red-800 @break
                                                @endswitch">
                                                {{ ucfirst($task->priority) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="px-2 py-1 font-semibold leading-tight text-xs rounded-full 
                                                @switch($task->status)
                                                    @case('open') bg-blue-100 text-blue-800 @break
                                                    @case('in_progress') bg-purple-100 text-purple-800 @break
                                                    @case('completed') bg-green-100 text-green-800 @break
                                                @endswitch">
                                                {{ str_replace('_', ' ', ucfirst($task->status)) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">{{ $task->assignedTo->name ?? 'N/A' }}</td>
                                        <td class="px-6 py-4">
                                            @if ($task->related)
                                                {{ class_basename($task->related_type) }}: {{ $task->related->name ?? $task->related->title ?? 'N/A' }}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <a href="{{ route('tasks.edit', $task) }}" class="font-medium text-emerald-600 dark:text-emerald-500 hover:underline">Edit</a>
                                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline-block ml-4">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="font-medium text-red-600 dark:text-red-500 hover:underline" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td colspan="7" class="px-6 py-4 text-center">No tasks found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6">
                        {{ $tasks->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
