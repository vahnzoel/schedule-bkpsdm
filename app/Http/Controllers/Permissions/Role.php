<?php

namespace App\Livewire\Permission;

use Spatie\Permission\Models\Role as roles;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;

class Role extends Component
{
    use WithPagination, WithoutUrlPagination, WithFileUploads, LivewireAlert;

    public $Mode = 'index';
    public $search = '';
    public $entries = '10';

    #[Validate('required', message: 'Name harus diisi!')]
    public $name;
    #[Validate('required', message: 'Permission harus diisi!')]
    public $permission;

    public $role_id;
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
            $entri = roles::count();
        } else {
            $entri = $this->entries;
        }
        $role = roles::orderby('created_at', 'ASC')
            ->where('name', 'like', '%' . $this->search . '%')
            ->paginate($entri);
        $permissions = Permission::get();
        $roles = Role::findOrFail($this->role_id);
        $rolePermissions = DB::table('role_has_permissions')
            ->where('role_has_permissions.role_id', $this->role_id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();
        return view('livewire.permissions.role', compact('role', 'permissions', 'roles', 'rolePermissions'));
    }

    public function resetFields()
    {
        $this->name = '';
        $this->permission = '';
        $this->role_id = '';
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
                'unique:roles,name'
            ]
        ]);

        if (roles::create([
            'name' => $this->name,
        ])) {
            $this->alert('success', 'Role berhasil di buat!', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
                'timerProgressBar' => true,
            ]);
            $this->Mode = 'index';
            $this->resetFields();
        } else {
            $this->alert('error', 'Role gagal di buat!', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
                'timerProgressBar' => true,
            ]);
        }
    }

    public function edit($id)
    {
        $role = roles::findOrFail($id);
        $this->role_id = $id;
        $this->name = $role->name;

        $this->Mode = 'edit';
    }

    public function update()
    {
        $this->validate([
            'name' => [
                'string',
                'unique:roles,name,' . $this->role_id
            ]
        ]);

        $role = roles::find($this->role_id);
        if ($role->update([
            'name' => $this->name
        ])) {
            $this->alert('success', 'Role berhasil di update!', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
                'timerProgressBar' => true,
            ]);
            $this->Mode = 'index';
            $this->resetFields();
        } else {
            $this->alert('error', 'Role gagal di update!', [
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
        if (roles::find($this->delete_id)->delete()) {
            $this->alert('success', 'Role berhasil di hapus!', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
                'timerProgressBar' => true,
            ]);
            $this->resetFields();
        } else {
            $this->alert('error', 'Role gagal di hapus!', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
                'timerProgressBar' => true,
            ]);
        }
    }

    public function addPermissionToRole($roleId)
    {
        $this->role_id = $roleId;
        $this->Mode = 'addPermissionToRole';
    }

    public function givePermissionToRole($roleId)
    {
        $this->validate();

        $role = Role::findOrFail($roleId);

        if ($role->syncPermissions($this->permission)) {
            $this->Mode = 'index';
            $this->alert('success', 'Role berhasil di tambahkan!', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
                'timerProgressBar' => true,
            ]);
            $this->resetFields();
        } else {
            $this->alert('error', 'Role gagal di tambahkan!', [
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
