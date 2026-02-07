<?php

namespace App\Livewire\Permission;

use App\Models\User as users;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;

class User extends Component
{
    use WithPagination, WithoutUrlPagination, WithFileUploads, LivewireAlert;

    public $Mode = 'index';
    public $search = '';
    public $entries = '10';

    public $name;
    public $username;
    public $role;
    public $user_id;
    public $delete_id;

    public function getListeners()
    {
        return [
            'destroy',
            'cancel'
        ];
    }

    public function render()
    {
        if ($this->entries == 'all') {
            $entri = users::count();
        } else {
            $entri = $this->entries;
        }
        $user = users::orderby('created_at', 'ASC')
            ->where('name', 'like', '%' . $this->search . '%')
            ->orWhere('ni_pppk', 'like', '%' . $this->search . '%')
            ->paginate($entri);
        return view('livewire.permissions.user', compact('user'));
    }

    public function resetFields()
    {
        $this->name = '';
        $this->username = '';
        $this->role = '';
        $this->user_id = '';
        $this->delete_id = '';
    }

    public function create()
    {
        $this->resetFields();
        $this->Mode = 'create';
    }

    public function store()
    {
        $this->validate([
            'name' => [
                'string'
            ],
            'username' => [
                'string',
                'unique:users,ni_pppk'
            ],
            'roles' => ['required']
        ]);

        if (users::create([
            'name' => $this->name,
            'username' => $this->username,
        ])->assignRole($this->role)) {
            $this->alert('success', 'User berhasil di buat!', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
                'timerProgressBar' => true,
            ]);
            $this->Mode = 'index';
            $this->resetFields();
        } else {
            $this->alert('error', 'User gagal di buat!', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
                'timerProgressBar' => true,
            ]);
        }
    }

    public function edit($id)
    {
        $user = users::findOrFail($id);
        $this->user_id = $id;
        $this->name = $user->name;
        $this->username = $user->username;

        $this->Mode = 'edit';
    }

    public function update()
    {
        $this->validate([
            'name' => [
                'string',
                'unique:permissions,name,' . $this->user_id
            ]
        ]);

        $user = users::find($this->user_id);
        if ($user->update([
            'name' => $this->name,
            'username' => $this->username,
        ])) {
            $this->alert('success', 'User berhasil di update!', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
                'timerProgressBar' => true,
            ]);
            $this->Mode = 'index';
            $this->resetFields();
        } else {
            $this->alert('error', 'User gagal di update!', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
                'timerProgressBar' => true,
            ]);
        }
    }

    public function delete($id)
    {
        $this->delete_id = $id;
        $this->alert('warning', 'Konfirmasi Hapus', [
            'position' => 'center',
            'timer' => null,
            'toast' => false,
            'text' => 'Apa anda yakin?',
            'iconHtml' => '<i
            class="far fa-trash-alt"></i>',
            'showConfirmButton' => true,
            'confirmButtonColor' => '#dd6b55',
            'onConfirmed' => 'destroy',
            'showCancelButton' => true,
            'onDismissed' => 'cancel',
            'confirmButtonText' => '<i class="far fa-trash-alt"></i> Ya, hapus!',
            'cancelButtonText' => 'Cancel',
        ]);
    }

    public function destroy()
    {
        if (users::find($this->delete_id)->delete()) {
            $this->alert('success', 'Permission berhasil di hapus!', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
                'timerProgressBar' => true,
            ]);
            $this->resetFields();
        } else {
            $this->alert('error', 'Permission gagal di hapus!', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
                'timerProgressBar' => true,
            ]);
        }
    }

    public function cancel()
    {
        $this->Mode = 'index';
        $this->resetFields();
        $this->resetValidation();
    }
}
