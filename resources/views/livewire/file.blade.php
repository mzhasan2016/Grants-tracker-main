<?php
 use Illuminate\Support\Facades\Storage;
?>

<div>

    <!- New Codes below ->


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @if (session()->has('message'))
                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                  <div class="flex">
                    <div>
                      <p class="text-sm">{{ session('message') }}</p>
                    </div>
                  </div>
                </div>
            @endif

            @if ($user->role != 'read only')
                <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Upload A New File</button>
            @endif

            @if($isOpen)
                @include('livewire.file.create')
            @endif
            @if($updateMode)
                @include('livewire.file.update')
            @endif
                <table class="table-fixed w-full">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2">File Name <a href="" ><x-gmdi-sort class="w-6 h-6 rounded my-3 inline" /></a></th>
                            <th class="px-4 py-2">Description</th>
                            <th class="px-4 py-2">Date Added <x-gmdi-sort wire:click="renderDifferent()" class="w-6 h-6 rounded my-3 inline" /></th>
                            <th class="px-4 py-2 w-1/4">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($multimedias as $multimedia)
                            <tr>
                                <td class="border px-4 py-2">{{ Str::of($multimedia->name)->words(3, ' ...') }}</td>
                                <td class="border px-4 py-2">{{ Str::of($multimedia->description)->words(3, ' ...') }}</td>
                                <td class="border px-4 py-2">{{ $multimedia->created_at->format('d/m/Y') }}</td>
                                <td class="border px-4 py-2 w-1/4">
                                    @if ($user->role != 'read only')
                                        <x-gmdi-download-r wire:click="fileDownload({{ $multimedia->id }})"
                                            class="w-12 h-12 rounded my-3 inline" />
                                        <x-gmdi-edit-note wire:click="edit({{ $multimedia->id }})"
                                            class="w-12 h-12 rounded my-3 inline" />
                                        <x-gmdi-delete
                                            onclick="confirm('Are you sure you want to delete the {{ Str::of($multimedia->name)->words(3, ' ...') }} file?') || event.stopImmediatePropagation()"
                                            wire:click="delete({{ $multimedia->id }})"
                                            class="w-12 h-12 rounded my-3 inline" />
                                    @else
                                        <div class="flex items-center justify-center">
                                            <x-gmdi-download-r wire:click="fileDownload({{ $multimedia->id }})"
                                                class="w-12 h-12 rounded my-3 inline" />
                                        </div>
                                    @endif
                                    </td>
                            </tr>
                        @endforeach
                        {{ $multimedias->links() }}
                    </tbody>
                </table>
        </div>
    </div>
</div>
</div>




