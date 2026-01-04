<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Upload New Document') }}
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

                    <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            
                            <div>
                                <x-input-label for="file" :value="__('Document File')" />
                                <input id="file" name="file" type="file" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-emerald-500 dark:focus:border-emerald-600 focus:ring-emerald-500 dark:focus:ring-emerald-600 rounded-md shadow-sm" required />
                                <x-input-error class="mt-2" :messages="$errors->get('file')" />
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

                            <div>
                                <x-input-label for="related_id" :value="__('Related To Item')" />
                                <select id="related_id" name="related_id" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-emerald-500 dark:focus:border-emerald-600 focus:ring-emerald-500 dark:focus:ring-emerald-600 rounded-md shadow-sm">
                                    <option value="">None</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('related_id')" />
                            </div>
                        </div>

                        <div class="flex items-center gap-4 mt-6">
                            <x-primary-button>{{ __('Upload') }}</x-primary-button>
                            <a href="{{ route('documents.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900">{{ __('Cancel') }}</a>
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
            const oldRelatedType = '{{ old('related_type') }}';
            const oldRelatedId = '{{ old('related_id') }}';

            function updateRelatedIdOptions() {
                const selectedRelatedType = relatedTypeSelect.value;
                
                // Clear current options
                relatedIdSelect.innerHTML = '';

                // Add default "None" option
                const noneOption = document.createElement('option');
                noneOption.value = "";
                noneOption.textContent = "None";
                relatedIdSelect.appendChild(noneOption);

                // Add options based on selected type
                let items = [];
                if (selectedRelatedType === 'App\\Models\\Lead') {
                    items = @json($leads->map(fn($item) => ['id' => $item->id, 'name' => $item->name]));
                } else if (selectedRelatedType === 'App\\Models\\Contact') {
                    items = @json($contacts->map(fn($item) => ['id' => $item->id, 'name' => $item->name]));
                } else if (selectedRelatedType === 'App\\Models\\Deal') {
                    items = @json($deals->map(fn($item) => ['id' => $item->id, 'name' => $item->title]));
                }

                items.forEach(item => {
                    const option = document.createElement('option');
                    option.value = item.id;
                    option.textContent = item.name;
                    relatedIdSelect.appendChild(option);
                });

                // Pre-select old value if it belongs to the current type
                if (selectedRelatedType === oldRelatedType && oldRelatedId) {
                    relatedIdSelect.value = oldRelatedId;
                }
            }

            relatedTypeSelect.addEventListener('change', updateRelatedIdOptions);
            
            // Initial call to set up options if an old relatedType was selected
            // This ensures the dropdown is correctly populated on validation error redirects
            if (oldRelatedType) {
                updateRelatedIdOptions();
            }
        });
    </script>
</x-app-layout>