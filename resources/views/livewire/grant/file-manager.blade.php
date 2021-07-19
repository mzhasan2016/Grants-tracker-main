<div>
    @if ($grant->hasMedia())
        <ul class="border border-gray-200 rounded-md divide-y divide-gray-200 mb-5">
            @foreach ($grant->getMedia() as $media)
                <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                    <div class="w-0 flex-1 flex items-center">
                        <svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd" />
                        </svg>
                        <span class="ml-2 flex-1 w-0 truncate">
                            {{ $media->file_name }}
                        </span>
                    </div>
                    <div class="ml-4 flex-shrink-0">
                        <a wire:click.prevent="downloadMedia({{ $media->id }})" download role="button" href="#" class="font-medium text-indigo-600 hover:text-indigo-500">
                            Download
                        </a>
                        @if (Gate::allows('not-read-only'))
                            -
                            <a wire:click.prevent="removeMedia({{ $media->id }})" role="button" href="#" class="font-medium text-indigo-600 hover:text-indigo-500">
                                Remove
                            </a>
                        @endif
                    </div>
                </li>
            @endforeach
        </ul>
    @endif

    @if (Gate::allows('not-read-only'))
        <div
            x-data="{ isUploading: false, progress: 0 }"
            x-on:livewire-upload-start="isUploading = true"
            x-on:livewire-upload-finish="isUploading = false"
            x-on:livewire-upload-error="isUploading = false"
            x-on:livewire-upload-progress="progress = $event.detail.progress"
        >

            <form wire:submit.prevent="saveMedia">
                <input id="upload{{ $iteration }}" type="file" wire:model="files" multiple>

                @error('files.*') <span class="error">{{ $message }}</span> @enderror
                <button type="submit" wire:loading.attr="disabled" wire:loading.class.remove="hover:bg-indigo-700" class="disabled:opacity-50 w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mt-3 sm:w-auto sm:text-sm">
                    Upload
                </button>
            </form>


            <div x-show="isUploading">
                <progress max="100" x-bind:value="progress"></progress>
            </div>
        </div>
    @endif
</div>
