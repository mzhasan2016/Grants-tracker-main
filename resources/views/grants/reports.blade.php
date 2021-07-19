<x-layout title="Grant Reports">
    <x-navigation />

    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-lg text-gray-800 leading-tight">
                Grant Reports
            </h2>
        </div>
    </header>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <livewire:grants-report-table />
    </div>
</x-layout>