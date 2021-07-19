<div>
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6 flex justify-end">
            <div class="" x-data="{}">
                <button @click="$dispatch('open-modal', 'create-user')" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Create user
                </button>
            </div>
        </div>
        <div class="border-t border-gray-200">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Role
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            email
                        </th>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Edit</span>
                        </th>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Delete</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($users as $user)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $user->name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $user->role }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $user->email }}</div>
                            </td>
                            <td class="pr-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a wire:click.prevent="updateUserModal({{ $user->id }})" role="button" href="#" class="text-indigo-600 hover:text-indigo-900">
                                    Edit
                                </a>
                            </td>
                            <td class="pr-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a wire:click.prevent="confirmUserRemoval({{ $user->id }})" role="button" href="#" class="text-indigo-600 hover:text-indigo-900">
                                    Delete
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

    <x-modal-livewire id="showUserRemovalModal" maxWidth="md">
        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="sm:flex sm:items-start">
                <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                    <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
                        Delete User
                    </h3>
                    <div class="mt-2">
                        <p class="text-sm text-gray-500">
                            Are you sure you want to delete this user? This user will be permanently removed. This action cannot be undone.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
            <button wire:click.prevent="removeUser({{ $userRemoval }})" type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                Delete
            </button>

            <button @click="show = false" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                Cancel
            </button>
        </div>
    </x-modal-livewire>

    <x-modal-livewire id="showUserUpdateModal" maxWidth="sm">
        <form wire:submit.prevent="updateUser">
            @csrf
            <div class="px-6 py-4">
                <h3 class="text-lg font-medium text-gray-900">
                    Update User
                </h3>

                <div class="mt-3">
                    <div class="space-y-6">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6">
                                <label for="updateName" class="block text-sm font-medium text-gray-700">
                                    Name
                                </label>
                                <input required wire:model="updateName" type="text" name="updateName" id="updateName" placeholder="Name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>

                            <div class="col-span-6">
                                <label for="updateRole" class="block text-sm font-medium text-gray-700">
                                    Role
                                </label>
                                <select required wire:model="updateRole" name="updateRole" id="updateRole" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option value="user">User</option>
                                    <option value="read only">Read only</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>

                            <div class="col-span-6">
                                <label for="updateEmail" class="block text-sm font-medium text-gray-700">
                                    Email address
                                </label>
                                <input required wire:model="updateEmail" type="email" name="updateEmail" id="updateEmail" placeholder="you@example.com" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>

                            <div class="col-span-6">
                                <label for="updatePassword" class="block text-sm font-medium text-gray-700">
                                    New password
                                </label>
                                <input wire:model="updatePassword" type="password" name="updatePassword" id="updatePassword" placeholder="Password" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>

                            <div class="col-span-6">
                                <label for="updatePasswordConfirm" class="block text-sm font-medium text-gray-700">
                                    Confirm new password
                                </label>
                                <input wire:model="updatePasswordConfirm" type="password" name="updatePasswordConfirm" id="updatePasswordConfirm" placeholder="Confirm password" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <div class="col-span-6 sm:col-span-6">
                                @foreach ($errors->all() as $error)
                                    <p class="@if (!$loop->first) mt-2 @endif text-sm leading-5 text-red-600">
                                        {{ $error }}
                                    </p>
                                @endforeach
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

    <x-modal maxWidth="sm" id="create-user">
        <form wire:submit.prevent="createUser">
            @csrf
            <div class="px-6 py-4">
                <h3 class="text-lg font-medium text-gray-900">
                    New User
                </h3>

                <div class="mt-3">
                    <div class="space-y-6">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6">
                                <label for="createName" class="block text-sm font-medium text-gray-700">
                                    Name
                                </label>
                                <input required wire:model="createName" type="text" name="createName" id="createName" placeholder="Name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>

                            <div class="col-span-6">
                                <label for="createRole" class="block text-sm font-medium text-gray-700">
                                    Role
                                </label>
                                <select required wire:model="createRole" name="createRole" id="createRole" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option value="user">User</option>
                                    <option value="read only">Read only</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>

                            <div class="col-span-6">
                                <label for="createEmail" class="block text-sm font-medium text-gray-700">
                                    Email address
                                </label>
                                <input required wire:model="createEmail" type="email" name="createEmail" id="createEmail" placeholder="you@example.com" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>

                            <div class="col-span-6">
                                <label for="createPassword" class="block text-sm font-medium text-gray-700">
                                    Password
                                </label>
                                <input required wire:model="createPassword" type="password" name="createPassword" id="createPassword" placeholder="Password" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>

                            <div class="col-span-6">
                                <label for="createPasswordConfirm" class="block text-sm font-medium text-gray-700">
                                    Confirm password
                                </label>
                                <input required wire:model="createPasswordConfirm" type="password" name="createPasswordConfirm" id="createPasswordConfirm" placeholder="Confirm password" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <div class="col-span-6 sm:col-span-6">
                                @foreach ($errors->all() as $error)
                                    <p class="@if (!$loop->first) mt-2 @endif text-sm leading-5 text-red-600">
                                        {{ $error }}
                                    </p>
                                @endforeach
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
    </x-modal>
</div>
