<div>
    <div class="flex justify-between mb-5">
        <select wire:model="pagination" id="pagination" name="pagination" class="block w-16 py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            <option value="10">10</option>
            <option value="9999999999999">All</option>
        </select>
    </div>

    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <a wire:click.prevent="sortBy('awarded_date')" role="button" href="#">
                                        Date awarded
                                        <x-sort-field-icon :sortField="$sortField" :sortAsc="$sortAsc" field="awarded_date" />
                                    </a>
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <a wire:click.prevent="sortBy('organization')" role="button" href="#">
                                        Organization
                                        <x-sort-field-icon :sortField="$sortField" :sortAsc="$sortAsc" field="organization" />
                                    </a>
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <a wire:click.prevent="sortBy('awards_sum_amount')" role="button" href="#">
                                        Awarded
                                        <x-sort-field-icon :sortField="$sortField" :sortAsc="$sortAsc" field="awards_sum_amount" />
                                    </a>
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <a wire:click.prevent="sortBy('receivings_sum_amount')" role="button" href="#">
                                        Received
                                        <x-sort-field-icon :sortField="$sortField" :sortAsc="$sortAsc" field="receivings_sum_amount" />
                                    </a>
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <a wire:click.prevent="sortBy('spendings_sum_amount')" role="button" href="#">
                                        Spent
                                        <x-sort-field-icon :sortField="$sortField" :sortAsc="$sortAsc" field="spendings_sum_amount" />
                                    </a>
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <a wire:click.prevent="sortBy('available')" role="button" href="#">
                                        Available
                                        <x-sort-field-icon :sortField="$sortField" :sortAsc="$sortAsc" field="available" />
                                    </a>
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <a wire:click.prevent="sortBy('spend_by_date')" role="button" href="#">
                                        Spend by
                                        <x-sort-field-icon :sortField="$sortField" :sortAsc="$sortAsc" field="spend_by_date" />
                                    </a>
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <a wire:click.prevent="sortBy('media_count')" role="button" href="#">
                                        Docs
                                        <x-sort-field-icon :sortField="$sortField" :sortAsc="$sortAsc" field="media_count" />
                                    </a>
                                </th>
                                <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">View</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($grants as $grant)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $grant->awarded_date->format('d-m-Y') }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900" id="tooltip-{{ $grant->id }}"
                                            x-data
                                            x-init="tippy(document.querySelector('#tooltip-{{ $grant->id }}'), { content: `{{ $grant->description }}` });">
                                            {{ $grant->organization }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $grant->getFormattedAwardedAmount() }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $grant->getFormattedReceivedAmount() }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $grant->getFormattedSpentAmount() }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $grant->getFormattedAvailableAmount() }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $grant->spend_by_date ? $grant->spend_by_date->format('d-m-Y') : '-' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $grant->hasMedia() ? 'Yes' : 'No' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="{{ route('grants.show', $grant->id) }}" class="text-indigo-600 hover:text-indigo-900">View</a>
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
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                        {{ $grants->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
