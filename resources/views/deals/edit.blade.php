<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Deal') }}
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

                    <form action="{{ route('deals.update', $deal) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            
                            <div>
                                <x-input-label for="title" :value="__('Deal Title')" />
                                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $deal->title)" required />
                                <x-input-error class="mt-2" :messages="$errors->get('title')" />
                            </div>
                            
                            <div>
                                <x-input-label for="company_id" :value="__('Company')" />
                                <select id="company_id" name="company_id" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-emerald-500 dark:focus:border-emerald-600 focus:ring-emerald-500 dark:focus:ring-emerald-600 rounded-md shadow-sm">
                                    <option value="">Select a company</option>
                                    @foreach($companies as $company)
                                        <option value="{{ $company->id }}" {{ old('company_id', $deal->company_id) == $company->id ? 'selected' : '' }}>{{ $company->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('company_id')" />
                            </div>

                            <div>
                                <x-input-label for="contact_id" :value="__('Contact')" />
                                <select id="contact_id" name="contact_id" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-emerald-500 dark:focus:border-emerald-600 focus:ring-emerald-500 dark:focus:ring-emerald-600 rounded-md shadow-sm">
                                    <option value="">Select a contact</option>
                                    @foreach($contacts as $contact)
                                        <option value="{{ $contact->id }}" {{ old('contact_id', $deal->contact_id) == $contact->id ? 'selected' : '' }}>{{ $contact->name }} ({{ $contact->company->name ?? 'N/A' }})</option>
                                    @endforeach
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('contact_id')" />
                            </div>
                            
                            <div>
                                <x-input-label for="assigned_to" :value="__('Assigned To')" />
                                <select id="assigned_to" name="assigned_to" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-emerald-500 dark:focus:border-emerald-600 focus:ring-emerald-500 dark:focus:ring-emerald-600 rounded-md shadow-sm">
                                    <option value="">Select a user</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ old('assigned_to', $deal->assigned_to) == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('assigned_to')" />
                            </div>

                            <div>
                                <x-input-label for="value" :value="__('Value')" />
                                <x-text-input id="value" name="value" type="number" step="0.01" class="mt-1 block w-full" :value="old('value', $deal->value)" required />
                                <x-input-error class="mt-2" :messages="$errors->get('value')" />
                            </div>

                            <div>
                                <x-input-label for="stage" :value="__('Stage')" />
                                <select id="stage" name="stage" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-emerald-500 dark:focus:border-emerald-600 focus:ring-emerald-500 dark:focus:ring-emerald-600 rounded-md shadow-sm">
                                    <option value="qualification" {{ old('stage', $deal->stage) == 'qualification' ? 'selected' : '' }}>Qualification</option>
                                    <option value="proposal" {{ old('stage', $deal->stage) == 'proposal' ? 'selected' : '' }}>Proposal</option>
                                    <option value="negotiation" {{ old('stage', $deal->stage) == 'negotiation' ? 'selected' : '' }}>Negotiation</option>
                                    <option value="won" {{ old('stage', $deal->stage) == 'won' ? 'selected' : '' }}>Won</option>
                                    <option value="lost" {{ old('stage', $deal->stage) == 'lost' ? 'selected' : '' }}>Lost</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('stage')" />
                            </div>

                            <div>
                                <x-input-label for="probability" :value="__('Probability (%)')" />
                                <x-text-input id="probability" name="probability" type="number" class="mt-1 block w-full" :value="old('probability', $deal->probability)" min="0" max="100" required />
                                <x-input-error class="mt-2" :messages="$errors->get('probability')" />
                            </div>
                            
                            <div>
                                <x-input-label for="expected_close_date" :value="__('Expected Close Date')" />
                                <x-text-input id="expected_close_date" name="expected_close_date" type="date" class="mt-1 block w-full" :value="old('expected_close_date', $deal->expected_close_date ? \Carbon\Carbon::parse($deal->expected_close_date)->format('Y-m-d') : '')" />
                                <x-input-error class="mt-2" :messages="$errors->get('expected_close_date')" />
                            </div>
                        </div>

                        <div class="flex items-center gap-4 mt-6">
                            <x-primary-button>{{ __('Save Changes') }}</x-primary-button>
                            <a href="{{ route('deals.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900">{{ __('Cancel') }}</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
