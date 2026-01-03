<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add New Task') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @if ($errors->any())
                        <div class="mb-4">
                            <div class="font-medium text-red-600">{{ __('Whoops! Something went wrong.') }}</div>
                            <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('tasks.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            
                            <div>
                                <x-input-label for="title" :value="__('Task Title')" />
                                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title')" required />
                                <x-input-error class="mt-2" :messages="$errors->get('title')" />
                            </div>
                            
                            <div>
                                <x-input-label for="assigned_to" :value="__('Assigned To')" />
                                <select id="assigned_to" name="assigned_to" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-emerald-500 dark:focus:border-emerald-600 focus:ring-emerald-500 dark:focus:ring-emerald-600 rounded-md shadow-sm">
                                    <option value="">Select a user</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ old('assigned_to') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('assigned_to')" />
                            </div>

                            <div>
                                <x-input-label for="description" :value="__('Description')" />
                                <textarea id="description" name="description" rows="3" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-emerald-500 dark:focus:border-emerald-600 focus:ring-emerald-500 dark:focus:ring-emerald-600 rounded-md shadow-sm">{{ old('description') }}</textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('description')" />
                            </div>

                            <div>
                                <x-input-label for="due_date" :value="__('Due Date')" />
                                <x-text-input id="due_date" name="due_date" type="date" class="mt-1 block w-full" :value="old('due_date')" />
                                <x-input-error class="mt-2" :messages="$errors->get('due_date')" />
                            </div>

                            <div>
                                <x-input-label for="priority" :value="__('Priority')" />
                                <select id="priority" name="priority" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-emerald-500 dark:focus:border-emerald-600 focus:ring-emerald-500 dark:focus:ring-emerald-600 rounded-md shadow-sm">
                                    <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Low</option>
                                    <option value="medium" {{ old('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                                    <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('priority')" />
                            </div>

                            <div>
                                <x-input-label for="status" :value="__('Status')" />
                                <select id="status" name="status" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-emerald-500 dark:focus:border-emerald-600 focus:ring-emerald-500 dark:focus:ring-emerald-600 rounded-md shadow-sm">
                                    <option value="open" {{ old('status') == 'open' ? 'selected' : '' }}>Open</option>
                                    <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('status')" />
                            </div>

                            <div x-data="{ relatedType: '{{ old('related_type') }}', relatedId: '{{ old('related_id') }}' }">
                                <x-input-label for="related_type" :value="__('Related To Type')" />
                                <select id="related_type" name="related_type" x-model="relatedType" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-emerald-500 dark:focus:border-emerald-600 focus:ring-emerald-500 dark:focus:ring-emerald-600 rounded-md shadow-sm">
                                    <option value="">None</option>
                                    @foreach($relatedTypes as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('related_type')" />
                            </div>

                            <div x-data="{ relatedType: '{{ old('related_type') }}', relatedId: '{{ old('related_id') }}' }">
                                <x-input-label for="related_id" :value="__('Related To Item')" />
                                <select id="related_id" name="related_id" x-model="relatedId" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-emerald-500 dark:focus:border-emerald-600 focus:ring-emerald-500 dark:focus:ring-emerald-600 rounded-md shadow-sm">
                                    <option value="">None</option>
                                    <template x-if="relatedType === 'App\Models\Lead'">
                                        @foreach($leads as $lead)
                                            <option value="{{ $lead->id }}" x-bind:selected="relatedId == {{ $lead->id }}">{{ $lead->name }}</option>
                                        @endforeach
                                    </template>
                                    <template x-if="relatedType === 'App\Models\Contact'">
                                        @foreach($contacts as $contact)
                                            <option value="{{ $contact->id }}" x-bind:selected="relatedId == {{ $contact->id }}">{{ $contact->name }}</option>
                                        @endforeach
                                    </template>
                                    <template x-if="relatedType === 'App\Models\Deal'">
                                        @foreach($deals as $deal)
                                            <option value="{{ $deal->id }}" x-bind:selected="relatedId == {{ $deal->id }}">{{ $deal->title }}</option>
                                        @endforeach
                                    </template>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('related_id')" />
                            </div>
                        </div>

                        <div class="flex items-center gap-4 mt-6">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>
                            <a href="{{ route('tasks.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900">{{ __('Cancel') }}</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const relatedTypeSelect = document.getElementById('related_type');
            const relatedIdSelect = document.getElementById('related_id');

            function updateRelatedIdOptions() {
                const selectedRelatedType = relatedTypeSelect.value;
                
                // Clear current options
                for (let i = relatedIdSelect.options.length - 1; i > 0; i--) {
                    relatedIdSelect.remove(i);
                }

                // Add options based on selected type
                if (selectedRelatedType === 'App\Models\Lead') {
                    @foreach($leads as $lead)
                        const option = document.createElement('option');
                        option.value = "{{ $lead->id }}";
                        option.textContent = "{{ $lead->name }}";
                        relatedIdSelect.appendChild(option);
                    @endforeach
                } else if (selectedRelatedType === 'App\Models\Contact') {
                    @foreach($contacts as $contact)
                        const option = document.createElement('option');
                        option.value = "{{ $contact->id }}";
                        option.textContent = "{{ $contact->name }}";
                        relatedIdSelect.appendChild(option);
                    @endforeach
                } else if (selectedRelatedType === 'App\Models\Deal') {
                    @foreach($deals as $deal)
                        const option = document.createElement('option');
                        option.value = "{{ $deal->id }}";
                        option.textContent = "{{ $deal->title }}";
                        relatedIdSelect.appendChild(option);
                    @endforeach
                }
                // Pre-select old value if available
                const oldRelatedId = '{{ old('related_id') }}';
                if (oldRelatedId) {
                    relatedIdSelect.value = oldRelatedId;
                }
            }

            relatedTypeSelect.addEventListener('change', updateRelatedIdOptions);
            
            // Initial call to set up options if an old relatedType was selected
            if (relatedTypeSelect.value) {
                updateRelatedIdOptions();
            }
        });
    </script>
</x-app-layout>
