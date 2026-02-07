<?php

namespace App\Livewire\Permission;

use Spatie\Permission\Models\Permission as permissions;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;

class Permission extends Component
{
    use WithPagination, WithoutUrlPagination, WithFileUploads, LivewireAlert;

    public $Mode = 'index';
    public $search = '';
    public $entries = '10';

    #[Validate('required', message: 'Name harus diisi!')]
    public $name;

    public $permission_id;
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
            $entri = permissions::count();
        } else {
            $entri = $this->entries;
        }
        $permission = permissions::orderby('created_at', 'ASC')
            ->where('name', 'like', '%' . $this->search . '%')
            ->paginate($entri);
        $permissions = Permission::get();
        return view('livewire.permissions.permission', compact('permission', 'permissions'));
    }

    public function resetFields()
    {
        $this->name = '';
        $this->permission_id = '';
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
                'string',
                'unique:permissions,name'
            ]
        ]);

        if (permissions::create([
            'name' => $this->name,
        ])) {
            $this->alert('success', 'Permission berhasil di buat!', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
                'timerProgressBar' => true,
            ]);
            $this->Mode = 'index';
            $this->resetFields();
        } else {
            $this->alert('error', 'Permission gagal di buat!', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
                'timerProgressBar' => true,
            ]);
        }
    }

    public function edit($id)
    {
        $permission = permissions::findOrFail($id);
        $this->permission_id = $id;
        $this->name = $permission->name;

        $this->Mode = 'edit';
    }

    public function update()
    {
        $this->validate([
            'name' => [
                'string',
                'unique:permissions,name,' . $this->permission_id
            ]
        ]);

        $permission = permissions::find($this->permission_id);
        if ($permission->update([
            'name' => $this->name
        ])) {
            $this->alert('success', 'Permission berhasil di update!', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
                'timerProgressBar' => true,
            ]);
            $this->Mode = 'index';
            $this->resetFields();
        } else {
            $this->alert('error', 'Permission gagal di update!', [
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
        if (permissions::find($this->delete_id)->delete()) {
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
