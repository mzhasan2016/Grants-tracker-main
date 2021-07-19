<div>
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Date
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Main category
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Sub category
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Spent
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Evidence outstanding
                </th>
                <th scope="col" class="relative px-6 py-3">
                    <span class="sr-only">View</span>
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse ($grant->spendings as $spending)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $spending->spent_at->format('d-m-Y') }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $spending->subcategory->category->name }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $spending->subcategory->name }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $spending->getFormattedSpentAmount() }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $spending->evidence_outstanding ? 'Yes' : 'No' }}</div>
                    </td>
                    <td class="pr-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a wire:click.prevent="showModal({{ $spending->id }})" role="button" href="#" class="text-indigo-600 hover:text-indigo-900">
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

    <x-modal-livewire id="editModalOpen" maxWidth="sm">
        <form wire:submit.prevent="updateSpending">
            @csrf
            <div class="px-6 py-4">
                <div class="flex justify-between">
                    <h3 class="text-lg font-medium text-gray-900">
                        Spending
                    </h3>

                    @if (Gate::allows('not-read-only'))
                        <a wire:click.prevent="showRemovalModal" role="button" href="#" class="text-indigo-600 hover:text-indigo-900 text-md font-medium">
                            Delete
                        </a>
                    @endif
                </div>

                <div class="mt-3">
                    <div class="space-y-6">
                        <div class="grid grid-cols-6 gap-6">
                            {{-- <input required type="hidden" name="subcategory_id" id="subcategory_id" value="{{ $selectedFundId }}"> --}}

                            <div class="col-span-6">
                                <label for="spent_date_edit_form" class="block text-sm font-medium text-gray-700">
                                    Date spent
                                </label>
                                {{-- <input required type="text" placeholder="DD-MM-YYYY" name="spent_date_edit_form" id="spent_date_edit_form" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"> --}}
                                <x-inputs.date-livewire required id="flatpickr_operation_date" wire:model="spendingDate" />
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
                                    <input @if (Gate::denies('not-read-only')) readonly @endif wire:model="spendingAmount" required type="number" min="1" step="any" name="amount" id="amount" placeholder="0.00" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-7 sm:text-sm border-gray-300 rounded-md">
                                </div>
                            </div>

                            <div class="col-span-6">
                                <label for="description_spending" class="block text-sm font-medium text-gray-700">
                                    Description
                                </label>
                                <input @if (Gate::denies('not-read-only')) readonly @endif wire:model="spendingDescription" placeholder="Description" type="text" name="description" id="description_spending" maxlength="100" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>

                            <div class="col-span-6">
                                <div class="flex items-start">
                                    <div class="flex items-center h-5">
                                        <input @if (Gate::denies('not-read-only')) onclick="return false;" @endif wire:model="spendingEvidenceOutstanding" value="1" id="evidence_outstanding" name="evidence_outstanding" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                    </div>
                                    <div class="ml-3 text-sm">
                                        <label for="evidence_outstanding" class="font-medium text-gray-700">Evidence outstanding</label>
                                        <p class="text-gray-500">Spending has evidence outstanding.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
        </form>
    </x-modal-livewire>

    <div x-data="{
            show: @entangle('RemovalModalOpen'),
            focusables() {
                // All focusable element types...
                let selector = 'a, button, input, textarea, select, details, [tabindex]:not([tabindex=\'-1\'])'
                return [...$el.querySelectorAll(selector)]
                    // All non-disabled elements...
                    .filter(el => ! el.hasAttribute('disabled'))
            },
            firstFocusable() { return this.focusables()[0] },
            lastFocusable() { return this.focusables().slice(-1)[0] },
            nextFocusable() { return this.focusables()[this.nextFocusableIndex()] || this.firstFocusable() },
            prevFocusable() { return this.focusables()[this.prevFocusableIndex()] || this.lastFocusable() },
            nextFocusableIndex() { return (this.focusables().indexOf(document.activeElement) + 1) % (this.focusables().length + 1) },
            prevFocusableIndex() { return Math.max(0, this.focusables().indexOf(document.activeElement)) -1 },
        }"
        x-on:close.stop="show = false"
        x-on:keydown.escape.window="show = false"
        x-on:keydown.tab.prevent="$event.shiftKey || nextFocusable().focus()"
        x-on:keydown.shift.tab.prevent="prevFocusable().focus()"
        x-show="show"
        id="deletion-modal-user"
        class="fixed top-0 inset-x-0 px-4 pt-6 z-50 sm:px-0 sm:flex sm:items-top sm:justify-center"
        style="display: none;">
        <div x-show="show" class="fixed inset-0 transform transition-all" x-on:click="show = false" x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <div x-show="show" class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:max-w-lg"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                        <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
                            Delete spending
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">
                                Are you sure you want to delete this spending? This spending will be permanently removed. This action cannot be undone.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button wire:click.prevent="removeSpending" type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Delete
                </button>

                <button @click="show = false" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>
