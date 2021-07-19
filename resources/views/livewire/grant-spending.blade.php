<div>
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Main category
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Sub category
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Received
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Spent
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Available
                </th>
                @if (Gate::allows('not-read-only'))
                    <th scope="col" class="relative px-6 py-3">
                        <span class="sr-only">Spend</span>
                    </th>
                @endif
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse ($subcategories as $subcategory)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $subcategory->category->name }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $subcategory->name }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $grant->formatMoney($grant->receivings->where('subcategory_id', $subcategory->id)->sum('amount')) }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $grant->formatMoney($grant->spendings->where('subcategory_id', $subcategory->id)->sum('amount')) }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $grant->formatMoney($grant->receivings->where('subcategory_id', $subcategory->id)->sum('amount') - $grant->spendings->where('subcategory_id', $subcategory->id)->sum('amount')) }}</div>
                    </td>
                    @if (Gate::allows('not-read-only'))
                        <td class="pr-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a wire:click.prevent="openSpendModal({{ $subcategory->id }})" role="button" href="#" class="text-indigo-600 hover:text-indigo-900">
                                Spend
                            </a>
                        </td>
                    @endif
                </tr>
            @empty
                <tr>
                    <td class="px-6 py-10 whitespace-nowrap">
                        <div class="text-sm leading-5 text-gray-500">
                            No available money to spend.
                        </div>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <x-modal-livewire maxWidth="sm" id="spendModalOpen">
        <form method="post" action="{{ route('grants.spendings.store', $grant->id) }}">
            @csrf
            <div class="px-6 py-4">
                <h3 class="text-lg font-medium text-gray-900">
                    Add spending
                </h3>

                <div class="mt-3">
                    <span class="px-2 py-1 inline-flex text-sm leading-5 font-semibold rounded bg-gray-100 text-gray-800">
                        {{ $subcategoryModel ? $subcategoryModel->category->name : null }}: {{ $subcategoryModel ? $subcategoryModel->name : null }}
                    </span>
                </div>

                <div class="mt-3">
                    <div class="space-y-6">
                        <div class="grid grid-cols-6 gap-6">
                            <input required type="hidden" name="subcategory_id" id="subcategory_id" value="{{ $subcategoryModel ? $subcategoryModel->id : null }}">

                            <div class="col-span-6">
                                <label for="spent_at" class="block text-sm font-medium text-gray-700">
                                    Date spent
                                </label>
                                <input required type="text" placeholder="DD-MM-YYYY" name="spent_at" id="spent_at" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>

                            <div class="col-span-6">
                                <label for="amount" class="block text-sm font-medium text-gray-700">
                                    Amount spent
                                </label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">
                                            £
                                        </span>
                                    </div>
                                    <input required type="number" min="1" step="any" name="amount" id="amount" placeholder="0.00" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-7 sm:text-sm border-gray-300 rounded-md">
                                </div>
                            </div>

                            <div class="col-span-6">
                                <label for="description_spending" class="block text-sm font-medium text-gray-700">
                                    Description
                                </label>
                                <input placeholder="Description" type="text" name="description" id="description_spending" maxlength="100" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>

                            <div class="col-span-6">
                                <div class="flex items-start">
                                    <div class="flex items-center h-5">
                                        <input value="1" id="evidence_outstanding" name="evidence_outstanding" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                    </div>
                                    <div class="ml-3 text-sm">
                                        <label for="evidence_outstanding" class="font-medium text-gray-700">Evidence outstanding</label>
                                        <p class="text-gray-500">Spending has evidence outstanding.</p>
                                    </div>
                                </div>
                            </div>

                            @if (!$this->isCategoryReceived())
                                <div class="col-span-6">
                                    <div class="rounded-md flex items-start lg:justify-center">
                                        <div class="flex-shrink-0">
                                            <svg class="h-6 w-6 text-yellow-600" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                                <path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                            </svg>
                                        </div>
                                        <div class="ml-3 flex-1 lg:flex lg:justify-between">
                                            <p class="text-sm leading-6 font-medium text-yellow-700">
                                                This category has not been received.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endif
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
</div>
