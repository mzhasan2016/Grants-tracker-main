<?php

namespace App\Http\Livewire\Settings;

use App\Models\User;
use Livewire\Component;
use Laravel\Fortify\Rules\Password;
use Illuminate\Support\Facades\Hash;

class UserManager extends Component
{
    public $showUserRemovalModal = false;
    public $showUserUpdateModal = false;

    public $createName;
    public $createRole;
    public $createEmail;
    public $createPassword;
    public $createPasswordConfirm;

    public $updateName;
    public $updateRole;
    public $updateEmail;
    public $updatePassword;
    public $updatePasswordConfirm;

    public $userRemoval;
    public $user;

    public function mount()
    {
        $this->createRole = 'user';
    }

    public function confirmUserRemoval($id)
    {
        $this->userRemoval = $id;

        $this->showUserRemovalModal = true;
    }

    public function removeUser($id)
    {
        User::destroy($id);

        $this->showUserRemovalModal = false;
    }

    public function updateUserModal($id)
    {
        $user = User::find($id);

        $this->user = $user;
        $this->updateName = $user->name;
        $this->updateRole = $user->role;
        $this->updateEmail = $user->email;

        $this->openUpdateModal();
    }

    public function updateUser()
    {
        $validatedData = $this->validate([
            'updateName' => ['required', 'string', 'max:255'],
            'updateRole' => ['required', 'string'],
            'updateEmail' => ['required', 'string', 'email', 'max:255'],
            'updatePassword' => ['nullable', 'string', 'same:updatePasswordConfirm', new Password],
            'updatePasswordConfirm' => ['nullable', 'string']
        ]);

        if($validatedData['updatePassword']) {
            $this->user->update(['password' => Hash::make($validatedData['updatePassword'])]);
        }

        $this->user->update([
            'name' => $validatedData['updateName'],
            'role' => $validatedData['updateRole'],
            'email' => $validatedData['updateEmail']
        ]);

        $this->closeUpdateModal();

        $this->clearFields();
    }

    public function createUser()
    {
        $validatedData = $this->validate([
            'createName' => ['required', 'string', 'max:255'],
            'createRole' => ['required', 'string'],
            'createEmail' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'createPassword' => ['required', 'string', 'same:createPasswordConfirm', new Password],
            'createPasswordConfirm' => ['required', 'string']
        ]);

        User::create([
            'name' => $validatedData['createName'],
            'role' => $validatedData['createRole'],
            'email' => $validatedData['createEmail'],
            'password' => Hash::make($validatedData['createPassword']),
        ]);

        return redirect()->route('settings');
    }

    public function clearFields()
    {
        $this->createName = null;
        $this->createRole = null;
        $this->createEmail = null;
        $this->createPassword = null;
        $this->createPasswordConfirm = null;
        $this->updateName = null;
        $this->updateRole = null;
        $this->updateEmail = null;
        $this->updatePassword = null;
        $this->updatePasswordConfirm = null;
    }

    public function openUpdateModal()
    {
        $this->showUserUpdateModal = true;
    }

    public function closeUpdateModal()
    {
        $this->showUserUpdateModal = false;
    }

    public function render()
    {
        return view('livewire.settings.user-manager', [
            'users' => User::all()
        ]);
    }
}
