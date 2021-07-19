<div>
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6 flex justify-between">
            <div>
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Money received
                    <span class="px-2 py-1 inline-flex text-sm leading-5 font-semibold rounded bg-green-100 text-green-800">
                        {{ $grant->getFormattedReceivedAmount() }}
                    </span>
                </h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                    Manage grant funding.
                </p>
            </div>
            @if (Gate::allows('not-read-only'))
                <div class="" x-data="{}">
                    <button @click="$dispatch('open-modal', 'create-category')" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Add funding
                    </button>
                </div>
            @endif
        </div>
        <div class="border-t border-gray-200">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Date
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Total amount
                        </th>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">View</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($receivings as $key => $receiving)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $receiving->first()->received_at->format('d-m-Y') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $grant->formatMoney($receiving->sum('amount')) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a wire:click.prevent="showFundDetails('{{ $key }}')" role="button" href="#" class="text-indigo-600 hover:text-indigo-900">
                                    View
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="px-6 py-10 whitespace-nowrap">
                                <div class="text-sm leading-5 text-gray-500">
                                    No records.
                                </div>
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <x-modal-livewire id="fundingModalOpen">
        <form wire:submit.prevent="updateDate">
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Funding
                    </h3>
                </div>
                <div class="border-t border-gray-200">
                    <dl>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Date
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                <x-inputs.date-livewire required id="temptemptemp" wire:model="date" />
                            </dd>
                        </div>
                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Total amount
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ $funds ? $grant->formatMoney($funds->sum('amount')) : null }}
                            </dd>
                        </div>
                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Categories
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            <ul class="border border-gray-200 rounded-md divide-y divide-gray-200">
                                @if ($funds)
                                    @foreach ($funds as $fund)
                                        <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                                            <div class="w-0 flex-1 flex items-center">
                                                <svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-14a3 3 0 00-3 3v2H7a1 1 0 000 2h1v1a1 1 0 01-1 1 1 1 0 100 2h6a1 1 0 100-2H9.83c.11-.313.17-.65.17-1v-1h1a1 1 0 100-2h-1V7a1 1 0 112 0 1 1 0 102 0 3 3 0 00-3-3z" clip-rule="evenodd" />
                                                </svg>
                                                <span class="ml-2 flex-1 w-0 truncate">
                                                    {{ $fund->subcategory->category->name }}: {{ $fund->subcategory->name }} - {{ $grant->formatMoney($fund->amount) }}
                                                </span>
                                            </div>
                                            @if (Gate::allows('not-read-only'))
                                                <div class="ml-4 flex-shrink-0">
                                                    <a wire:click.prevent="showReceivingEditModal({{ $fund->id }})" role="button" href="#" class="font-medium text-indigo-600 hover:text-indigo-500">
                                                        Edit
                                                    </a>
                                                    -
                                                    <a wire:click.prevent="confirmRemoval({{ $fund->id }})" role="button" href="#" class="font-medium text-indigo-600 hover:text-indigo-500">
                                                        Delete
                                                    </a>
                                                </div>
                                            @endif
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                            </dd>
                        </div>
                    </dl>
                </div>
                @if (Gate::allows('not-read-only'))
                    <div class="bg-gray-50 px-6 py-4 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Save
                        </button>

                        <button @click="show = false" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Cancel
                        </button>
                    </div>
                @endif
            </div>
        </form>
    </x-modal-livewire>

    <x-modal-livewire maxWidth="sm" id="receivingEditModalOpen">
        <form wire:submit.prevent="updateReceiving">
            <div class="px-6 py-4">
                <div class="flex">
                    <h3 class="text-lg font-medium text-gray-900">
                        Funding
                    </h3>
                </div>

                <div class="mt-3">
                    <div class="space-y-6">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6">
                                <label for="categories" class="block text-sm font-medium text-gray-700">
                                    Category
                                </label>
                                <select wire:model="receivingSubcategory" required name="categories" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    @foreach ($categories as $category)
                                            <optgroup label="{{ $category->name }}">
                                                @foreach ($category->subcategories as $subcategory)
                                                    <option value="{{ $subcategory->id }}">{{ $subcategory->category->name }}: {{ $subcategory->name }}</option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                </select>
                                @if (!$this->isCategoryAwarded($receivingSubcategory))
                                    <div class="pt-2 rounded-md flex items-start lg:justify-center">
                                        <div class="flex-shrink-0">
                                            <svg class="h-6 w-6 text-yellow-600" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                                <path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                            </svg>
                                        </div>
                                        <div class="ml-3 flex-1 lg:flex lg:justify-between">
                                            <p class="text-sm leading-6 font-medium text-yellow-700">
                                                This category has not been awarded.
                                            </p>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="col-span-6">
                                <label for="amount" class="block text-sm font-medium text-gray-700">
                                    Amount received
                                </label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">
                                            £
                                        </span>
                                    </div>
                                    <input wire:model="receivingAmount" required type="number" min="1" step="any" name="amount" id="amount" placeholder="0.00" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-7 sm:text-sm border-gray-300 rounded-md">
                                </div>
                            </div>
                        </div>
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
    </x-modal-livewire>

    <x-modal-livewire maxWidth="sm" id="receivingDeleteModalOpen">
        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="sm:flex sm:items-start">
                <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                    <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
                        Delete funding
                    </h3>
                    <div class="mt-2">
                        <p class="text-sm text-gray-500">
                            Are you sure you want to delete funding? This action cannot be undone.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
            <button wire:click.prevent="removeReceiving" type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                Delete
            </button>

            <button @click="show = false" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                Cancel
            </button>
        </div>
    </x-modal-livewire>

    <x-modal maxWidth="2xl" id="create-category" wire:ignore>
        <form method="post" action="{{ route('grants.receivings.store', $grant->id) }}">
            @csrf
            <div class="px-6 py-4">
                <h3 class="text-lg font-medium text-gray-900">
                    Add received money
                </h3>

                <div class="mt-3">
                    <div class="space-y-6">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-3 sm:col-span-3 lg:col-span-3">
                                <label for="awarded_date_funding" class="block text-sm font-medium text-gray-700">
                                    Received date
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
                                category: {{ $subcategories->first()->id }},
                                amount: '',
                                isAwarded: true
                            });

                            this.test();
                        },
                        removeField(index) {
                            this.fields.splice(index, 1);
                        },
                        async test() {
                            for (const field of this.fields) {
                                field.isAwarded = await $wire.isCategoryAwarded(field.category);
                            }
                        }
                    }">
                        <button @click="addNewField()" type="button" class="w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:w-auto sm:text-sm">
                            Add Funding Category
                        </button>

                        <template x-for="(field, index) in fields" :key="index">
                            <div class="grid grid-cols-10 gap-6">
                                <div class="col-span-5 sm:col-span-5 lg:col-span-5">
                                    <label class="block text-sm font-medium text-gray-700">
                                        Category
                                    </label>
                                    <select x-on:change="test()" x-model="field.category" required name="categories[]" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        @foreach ($categories as $category)
                                            <optgroup label="{{ $category->name }}">
                                                @foreach ($category->subcategories as $subcategory)
                                                    <option value="{{ $subcategory->id }}">{{ $subcategory->category->name }}: {{ $subcategory->name }}</option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                    <template x-if="!field.isAwarded">
                                        <div class="pt-2 rounded-md flex items-start lg:justify-center">
                                            <div class="flex-shrink-0">
                                                <svg class="h-6 w-6 text-yellow-600" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                                </svg>
                                            </div>
                                            <div class="ml-3 flex-1 lg:flex lg:justify-between">
                                                <p class="text-sm leading-6 font-medium text-yellow-700">
                                                    This category has not been awarded.
                                                </p>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                                <div class="col-span-4 sm:col-span-4 lg:col-span-4">
                                    <label class="block text-sm font-medium text-gray-700">
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
                                    <label class="block text-sm font-medium text-gray-700">
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
</div>
