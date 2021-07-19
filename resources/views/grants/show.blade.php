<x-layout title="Grant">
    <x-navigation />

    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-lg text-gray-800 leading-tight">
                Grant
            </h2>
        </div>
    </header>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

        <div class="grid grid-cols-8 gap-7">

            <div class="col-span-8 sm:col-span-5">
                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6 flex justify-between">
                        <div>
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                Grant Information
                            </h3>
                            <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                Information about the grant.
                            </p>
                        </div>
                        @if (Gate::allows('not-read-only'))
                            @if ($grant->isApplication())
                                <div class="" x-data="{}">
                                    <button  @click="$dispatch('open-modal', 'grant-notwon')" class="mt-3 mr-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                        Not won
                                    </button>

                                    <button @click="$dispatch('open-modal', 'grant-won')" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Won
                                    </button>
                                </div>
                            @endif

                            @if ($grant->isWon() AND !$grant->isComplete())
                                <div>
                                    <livewire:grant.complete-button :grant="$grant" />
                                </div>
                            @endif

                            @if ($grant->isComplete())
                                <div>
                                    <livewire:grant.undo-complete-button :grant="$grant" />
                                </div>
                            @endif
                        @endif
                    </div>
                    <form method="post" action="{{ route('grants.update', $grant->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="border-t border-gray-200 px-6 py-4">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="organization" class="block text-sm font-medium text-gray-700">
                                        Organization name
                                    </label>
                                    <input @if (Gate::denies('not-read-only')) readonly @endif required value="{{ $grant->organization }}" type="text" name="organization" id="organization" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="contact_person" class="block text-sm font-medium text-gray-700">
                                        Contact person
                                    </label>
                                    <input @if (Gate::denies('not-read-only')) readonly @endif value="{{ $grant->contact_person }}" type="text" name="contact_person" id="contact_person" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>

                                <div class="col-span-6 sm:col-span-3" x-data="{ email: '{{ $grant->email_address }}' }">
                                    <label for="email_address" class="block text-sm font-medium text-gray-700">
                                        Email address
                                    </label>
                                    <div class="mt-1 flex rounded-md shadow-sm">
                                        <input @if (Gate::denies('not-read-only')) readonly @endif @change="email = $event.target.value" value="{{ $grant->email_address }}" type="email" name="email_address" id="email_address" placeholder="you@example.com" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-l-md">
                                        <span class="inline-flex items-center px-3 rounded-r-md border border-l-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                            <a x-bind:href="'mailto:' + email" target="_blank">
                                                Email
                                            </a>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="phone_number" class="block text-sm font-medium text-gray-700">
                                        Phone number
                                    </label>
                                    <input @if (Gate::denies('not-read-only')) readonly @endif value="{{ $grant->phone_number }}" type="text" name="phone_number" id="phone_number" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>

                                <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                                    <label for="applied_amount" class="block text-sm font-medium text-gray-700">
                                        Applied amount
                                    </label>
                                    <div class="mt-1 relative rounded-md shadow-sm">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <span class="text-gray-500 sm:text-sm">
                                                £
                                            </span>
                                        </div>
                                        <input @if (Gate::denies('not-read-only')) readonly @endif required value="{{ $grant->applied_amount / 100 }}" type="number" min="1" step="any" name="applied_amount" id="applied_amount" placeholder="0.00" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-7 sm:text-sm border-gray-300 rounded-md">
                                    </div>
                                </div>

                                <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                    <label for="submitted_date" class="block text-sm font-medium text-gray-700">
                                        Submitted date
                                    </label>
                                    <input @if (Gate::denies('not-read-only')) disabled @endif required type="date" placeholder="DD-MM-YYYY" name="submitted_date" id="submitted_date" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>

                                <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                    <label for="decision_date" class="block text-sm font-medium text-gray-700">
                                        Decision date
                                    </label>
                                    <input @if (Gate::denies('not-read-only')) disabled @endif type="date" placeholder="DD-MM-YYYY" name="decision_date" id="decision_date" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>

                                <div class="col-span-6" x-data="{ url: '{{ $grant->website }}' }">
                                    <label for="website" class="block text-sm font-medium text-gray-700">
                                        Website
                                    </label>
                                    <div class="mt-1 flex rounded-md shadow-sm">
                                        <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                            https://
                                        </span>
                                        <input @if (Gate::denies('not-read-only')) readonly @endif @change="url = $event.target.value" value="{{ $grant->website }}" type="text" name="website" id="website" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none sm:text-sm border-gray-300" placeholder="www.example.com">
                                        <span class="inline-flex items-center px-3 rounded-r-md border border-l-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                            <a x-bind:href="'https://' + url" target="_blank">
                                                View
                                            </a>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-span-6">
                                    <label for="description" class="block text-sm font-medium text-gray-700">
                                        Description
                                    </label>
                                    <input @if (Gate::denies('not-read-only')) readonly @endif value="{{ $grant->description }}" type="text" name="description" id="description" maxlength="40" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>

                                <div class="col-span-6">
                                    <label for="notes" class="block text-sm font-medium text-gray-700">
                                        Notes
                                    </label>
                                    <textarea @if (Gate::denies('not-read-only')) readonly @endif id="notes" name="notes" rows="6" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Notes">{!! e($grant->notes) !!}</textarea>
                                </div>
                            </div>

                            @if ($grant->isWon())
                                <div class="py-5">
                                    <div class="border-t border-gray-200"></div>
                                </div>

                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                        <label for="awarded_date" class="block text-sm font-medium text-gray-700">
                                            Awarded date
                                        </label>
                                        <input @if (Gate::denies('not-read-only')) disabled @endif type="date" placeholder="DD-MM-YYYY" name="awarded_date" id="awarded_date" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    </div>

                                    <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                        <label for="spend_by_date" class="block text-sm font-medium text-gray-700">
                                            Spend by date
                                        </label>
                                        <input @if (Gate::denies('not-read-only')) disabled @endif type="date" placeholder="DD-MM-YYYY" name="spend_by_date" id="spend_by_date" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    </div>

                                    <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                        <label for="reporting_date" class="block text-sm font-medium text-gray-700">
                                            Reporting deadline
                                        </label>
                                        <input @if (Gate::denies('not-read-only')) disabled @endif type="date" placeholder="DD-MM-YYYY" name="reporting_date" id="reporting_date" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    </div>
                                </div>
                            @endif
                        </div>
                        @if (Gate::allows('not-read-only'))
                            <div class="bg-gray-50 px-6 py-4 sm:px-6 sm:flex sm:flex-row-reverse">
                                <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                                    Update
                                </button>
                            </div>
                        @endif
                    </form>
                </div>
            </div>

            <div class="col-span-8 sm:col-span-3">
                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6">
                      <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Documents
                      </h3>
                      <p class="mt-1 max-w-2xl text-sm text-gray-500">
                        Manage grant documents.
                      </p>
                    </div>
                    <div class="border-t border-gray-200 px-6 py-4">
                        <livewire:grant.file-manager :grant="$grant" />
                    </div>
                </div>
            </div>

            @if ($grant->isWon())
                <div class="col-span-8 sm:col-span-5">
                    <livewire:grant.awards-list :grant="$grant" />
                </div>

                <div class="col-span-8 sm:col-span-5">
                    <livewire:grant.receivings-list :grant="$grant" />
                </div>

                <div class="col-span-8 sm:col-span-5">
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                        <div class="px-4 py-5 sm:px-6 flex justify-between">
                            <div>
                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                    Money available to spend
                                </h3>
                                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                    Spend received money.
                                </p>
                            </div>
                        </div>
                        <div class="border-t border-gray-200">
                            <livewire:grant-spending :grant="$grant" />
                        </div>
                    </div>
                </div>

                <div class="col-span-8 sm:col-span-5">
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                        <div class="px-4 py-5 sm:px-6 flex justify-between">
                            <div>
                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                    Money spent
                                </h3>
                                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                    Manage grant spending.
                                </p>
                            </div>
                        </div>
                        <div class="border-t border-gray-200">
                            <livewire:grant-spent :grant="$grant" />
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>

    <x-modal maxWidth="sm" id="grant-notwon">
        <form method="post" action="{{ route('grants.notwon', $grant->id) }}">
            @method('put')
            @csrf
            <div class="px-6 py-4">
                <h3 class="text-lg font-medium text-gray-900">
                    Mark as not won
                </h3>

                <div class="mt-3">
                    <div class="space-y-6">
                        This grant will be removed from this section and only appear in reports.
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-6 py-4 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="submit" id="status" name="status" value="not won" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Not won
                </button>
                <button @click="show = false" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Cancel
                </button>
            </div>
        </form>
    </x-modal>

    <x-modal maxWidth="2xl" id="grant-won">
        <form method="post" action="{{ route('grants.won', $grant->id) }}">
            @csrf
            @method('put')
            <div class="px-6 py-4">
                <h3 class="text-lg font-medium text-gray-900">
                    Grant won
                </h3>

                <div class="mt-3">
                    <div class="space-y-6">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-2 sm:col-span-2 lg:col-span-2">
                                <label for="awarded_date" class="block text-sm font-medium text-gray-700">
                                    Awarded date
                                </label>
                                <input required type="date" placeholder="DD-MM-YYYY" name="awarded_date" id="awarded_date" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <div class="col-span-2 sm:col-span-2 lg:col-span-2">
                                <label for="spend_by_date" class="block text-sm font-medium text-gray-700">
                                    Spend by date
                                </label>
                                <input type="date" placeholder="DD-MM-YYYY" name="spend_by_date" id="spend_by_date" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <div class="col-span-2 sm:col-span-2 lg:col-span-2">
                                <label for="reporting_date" class="block text-sm font-medium text-gray-700">
                                    Reporting deadline
                                </label>
                                <input type="date" placeholder="DD-MM-YYYY" name="reporting_date" id="reporting_date" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                        </div>
                    </div>

                    <div class="py-5">
                        <div class="border-t border-gray-200"></div>
                    </div>

                    <div class="space-y-6" x-data="{
                        fields: [],
                        addNewField() {
                            this.fields.push({
                                category: '',
                                amount: ''
                            });
                        },
                        removeField(index) {
                            this.fields.splice(index, 1);
                        }
                    }">
                        <button @click="addNewField()" type="button" class="w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:w-auto sm:text-sm">
                            Add Funding Category
                        </button>

                        <template x-for="(field, index) in fields" :key="index">
                            <div class="grid grid-cols-10 gap-6">
                                <div class="col-span-5 sm:col-span-5 lg:col-span-5">
                                    <label for="awarded_date" class="block text-sm font-medium text-gray-700">
                                        Category
                                    </label>
                                    <select x-model="field.category" required name="categories[]" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        @foreach ($categories as $category)
                                            <optgroup label="{{ $category->name }}">
                                                @foreach ($category->subcategories as $subcategory)
                                                    <option value="{{ $subcategory->id }}">{{ $subcategory->category->name }}: {{ $subcategory->name }}</option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-span-4 sm:col-span-4 lg:col-span-4">
                                    <label for="spend_by_date" class="block text-sm font-medium text-gray-700">
                                        Amount
                                    </label>
                                    <div class="mt-1 relative rounded-md shadow-sm">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <span class="text-gray-500 sm:text-sm">
                                                £
                                            </span>
                                        </div>
                                        <input x-model="field.amount" required name="amounts[]" type="number" min="1" step="any" placeholder="0.00" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-7 sm:text-sm border-gray-300 rounded-md">
                                    </div>
                                </div>
                                <div class="col-span-1 sm:col-span-1 g:col-span-1">
                                    <label for="spend_by_date" class="block text-sm font-medium text-gray-700">
                                        Remove
                                    </label>
                                    <button @click="removeField(index)" type="button" class="mt-1 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:w-auto sm:text-sm">
                                        ✗
                                    </button>
                                </div>
                            </div>
                        </template>
                    </div>

                </div>
            </div>
            <div class="bg-gray-50 px-6 py-4 sm:px-6 sm:flex sm:flex-row-reverse">
                <button id="status" name="status" value="won" type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Save
                </button>
                <button @click="show = false" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Cancel
                </button>
            </div>
        </form>
    </x-modal>

    <x-modal maxWidth="2xl" id="add-awarded-money">
        <form method="post" action="{{ route('grants.awards.store', $grant->id) }}">
            @csrf
            <div class="px-6 py-4">
                <h3 class="text-lg font-medium text-gray-900">
                    Add awarded money
                </h3>

                <div class="mt-3">
                    <div class="space-y-6">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-3 sm:col-span-3 lg:col-span-3">
                                <label for="awarded_date_funding" class="block text-sm font-medium text-gray-700">
                                    Awarded date
                                </label>
                                <input required type="date" placeholder="DD-MM-YYYY" name="awarded_date_funding" id="awarded_date_funding" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                        </div>
                    </div>

                    <div class="py-5">
                        <div class="border-t border-gray-200"></div>
                    </div>

                    <div class="space-y-6" x-data="{
                        fields: [],
                        addNewField() {
                            this.fields.push({
                                category: '',
                                amount: ''
                            });
                        },
                        removeField(index) {
                            this.fields.splice(index, 1);
                        }
                    }">
                        <button @click="addNewField()" type="button" class="w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:w-auto sm:text-sm">
                            Add Funding Category
                        </button>

                        <template x-for="(field, index) in fields" :key="index">
                            <div class="grid grid-cols-10 gap-6">
                                <div class="col-span-5 sm:col-span-5 lg:col-span-5">
                                    <label for="awarded_date" class="block text-sm font-medium text-gray-700">
                                        Category
                                    </label>
                                    <select x-model="field.category" required name="categories[]" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        @foreach ($categories as $category)
                                            <optgroup label="{{ $category->name }}">
                                                @foreach ($category->subcategories as $subcategory)
                                                    <option value="{{ $subcategory->id }}">{{ $subcategory->category->name }}: {{ $subcategory->name }}</option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-span-4 sm:col-span-4 lg:col-span-4">
                                    <label for="spend_by_date" class="block text-sm font-medium text-gray-700">
                                        Amount
                                    </label>
                                    <div class="mt-1 relative rounded-md shadow-sm">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <span class="text-gray-500 sm:text-sm">
                                                £
                                            </span>
                                        </div>
                                        <input x-model="field.amount" required name="amounts[]" type="number" min="1" step="any" placeholder="0.00" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-7 sm:text-sm border-gray-300 rounded-md">
                                    </div>
                                </div>
                                <div class="col-span-1 sm:col-span-1 g:col-span-1">
                                    <label for="spend_by_date" class="block text-sm font-medium text-gray-700">
                                        Remove
                                    </label>
                                    <button @click="removeField(index)" type="button" class="mt-1 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:w-auto sm:text-sm">
                                        ✗
                                    </button>
                                </div>
                            </div>
                        </template>
                    </div>

                </div>
            </div>
            <div class="bg-gray-50 px-6 py-4 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Save
                </button>
                <button @click="show = false" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Cancel
                </button>
            </div>
        </form>
    </x-modal>

    @if (session()->has('error'))
        <x-error-notification message="{{ session('error') }}" />
    @endif

    @push('scripts')
        <script>
            flatpickr("#submitted_date", {
                enableTime: false,
                dateFormat: "d-m-Y",
                allowInput: true,
                defaultDate: "{{ $grant->submitted_date->format('d-m-Y') }}"
            });

            flatpickr("#decision_date", {
                enableTime: false,
                dateFormat: "d-m-Y",
                allowInput: true,
                defaultDate: "{{ $grant->decision_date ? $grant->decision_date->format('d-m-Y') : null }}"
            });

            flatpickr("#awarded_date", {
                enableTime: false,
                dateFormat: "d-m-Y",
                allowInput: true,
                defaultDate: "{{ $grant->awarded_date ? $grant->awarded_date->format('d-m-Y') : null }}"
            });

            flatpickr("#spend_by_date", {
                enableTime: false,
                dateFormat: "d-m-Y",
                allowInput: true,
                defaultDate: "{{ $grant->spend_by_date ? $grant->spend_by_date->format('d-m-Y') : null }}"
            });

            flatpickr("#reporting_date", {
                enableTime: false,
                dateFormat: "d-m-Y",
                allowInput: true,
                defaultDate: "{{ $grant->reporting_date ? $grant->reporting_date->format('d-m-Y') : null }}"
            });

            flatpickr("#spent_at", {
                enableTime: false,
                dateFormat: "d-m-Y",
                allowInput: true
            });

            flatpickr("#awarded_date_funding", {
                enableTime: false,
                dateFormat: "d-m-Y",
                allowInput: true
            });
        </script>
    @endpush
</x-layout>
