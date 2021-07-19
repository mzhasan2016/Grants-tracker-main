<x-layout title="Live Grants">
    <x-navigation />

    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-lg text-gray-800 leading-tight">
                Live Grants
            </h2>
        </div>
    </header>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="flex flex-col mb-5">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <div class="bg-white px-6 py-4">
                            <div class="grid grid-cols-4 gap-6">
                                @foreach ($categories as $category)
                                    <div class="sm:col-span-1 col-span-4">
                                        <span class="font-bold">{{ $category->name }}</span>
                                        <ul>
                                            @foreach ($category->subcategories->sortByDesc(fn ($subcategory) => $subcategory->available_amount) as $subcategory)
                                                <li>
                                                    {{ $subcategory->name }} - {{ $subcategory->getFormattedAvailableAmount() }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <livewire:grants-live-table />
    </div>
</x-layout>
