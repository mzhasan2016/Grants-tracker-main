<x-layout title="Grant Applications">
    <x-navigation />


    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        @livewire('file', ['user' => $user])
    </div>
</x-layout>
