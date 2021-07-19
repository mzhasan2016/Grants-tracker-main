<div>
    <form wire:submit.prevent="export">
        <div class="grid grid-cols-3 gap-6">
            <div class="col-span-2 sm:col-span-1">
                <label for="date_export_applied_from" class="block text-sm font-medium text-gray-700">
                    Date awarded from
                </label>
                <input wire:model="exportDateFrom" type="text" placeholder="DD-MM-YYYY" name="date_export_applied_from" id="date_export_applied_from" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            <div class="col-span-2 sm:col-span-1">
                <label for="date_export_applied_to" class="block text-sm font-medium text-gray-700">
                    Date awarded to
                </label>
                <input wire:model="exportDateTo" type="text" placeholder="DD-MM-YYYY" name="date_export_applied_to" id="date_export_applied_to" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            <div class="col-span-2 sm:col-span-1">
                <label for="grant_status" class="block text-sm font-medium text-gray-700">
                    Status
                </label>
                <select required wire:model="status" id="grant_status" name="grant_status" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="all">All</option>
                    <option value="application">Application</option>
                    <option value="won">Won</option>
                    <option value="not won">Not won</option>
                    <option value="complete">Complete</option>
                </select>
            </div>
        </div>

        <button type="submit" class="mt-5 w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:w-auto sm:text-sm">
            Export grants
        </button>
    </form>

    <div class="py-5">
        <div class="border-t border-gray-200"></div>
    </div>

    <form wire:submit.prevent="confirmGrantsRemoval">
        <div class="grid grid-cols-3 gap-6">
            <div class="col-span-2 sm:col-span-1">
                <label for="date_applied_from" class="block text-sm font-medium text-gray-700">
                    Date applied from
                </label>
                <input required wire:model="dateFrom" type="text" placeholder="DD-MM-YYYY" name="date_applied_from" id="date_applied_from" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            <div class="col-span-2 sm:col-span-1">
                <label for="date_applied_to" class="block text-sm font-medium text-gray-700">
                    Date applied to
                </label>
                <input required wire:model="dateTo" type="text" placeholder="DD-MM-YYYY" name="date_applied_to" id="date_applied_to" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            <div class="col-span-2 sm:col-span-1">
                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input wire:model="deleteTransactionsOnly" id="deleteTransactionsOnly" name="deleteTransactionsOnly" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="deleteTransactionsOnly" class="font-medium text-gray-700">
                            Transactions only
                        </label>
                        <p class="text-gray-500">
                            Remove transactions only.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="mt-5 w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:w-auto sm:text-sm">
            Delete grants
        </button>
    </form>


    <div x-data="{
            show: @entangle('showGrantRemovalModal'),
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
        id="deletion-modal-grant"
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
                            Delete Grants
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">
                                Are you sure you want to delete all grants/transactions between this date range? If you do not have a back up this data will be lost. This action cannot be undone.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button wire:click.prevent="DeleteGrants" type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Delete
                </button>

                <button @click="show = false" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Cancel
                </button>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            flatpickr("#date_export_applied_from", {
                enableTime: false,
                dateFormat: "d-m-Y",
                allowInput: true
            });

            flatpickr("#date_export_applied_to", {
                enableTime: false,
                dateFormat: "d-m-Y",
                allowInput: true
            });

            flatpickr("#date_applied_from", {
                enableTime: false,
                dateFormat: "d-m-Y",
                allowInput: true
            });

            flatpickr("#date_applied_to", {
                enableTime: false,
                dateFormat: "d-m-Y",
                allowInput: true
            });
        </script>
    @endpush
</div>
