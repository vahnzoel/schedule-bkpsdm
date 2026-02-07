<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination, WithoutUrlPagination, LivewireAlert;

    public $Mode = 'index';
    public $search = '';
    public $entries = '10';
    public $sortByColumn = 'name';
    public $sortDirection = 'DESC';

    #[Validate('required', message: 'Nama harus diisi!')]
    public $name;
    #[Validate('required', message: 'Username harus diisi!')]
    public $username;
    #[Validate('required', message: 'Bidang harus diisi!')]
    public $bidang;
    public $user_id;
    public $delete_id;
    public $pass_id;

    public function getListeners()
    {
        return [
            'destroy',
            'cancel',
            'pass'
        ];
    }

    public function setSortFunctionality($columnName)
    {
        if ($this->sortByColumn == $columnName) {
            $this->sortDirection = ($this->sortDirection == 'ASC') ? 'DESC' : 'ASC';
            return;
        }
        $this->sortByColumn = $columnName;
        $this->sortDirection = 'ASC';
    }

    public function render()
    {
        if ($this->entries == 'all') {
            $entri = User::count();
        } else {
            $entri = $this->entries;
        }
        $search = $this->search;
        $bid = Bidang::all();
        $data = User::Where('id', '!=', 1)
            ->search($search)
            ->orderby($this->sortByColumn, $this->sortDirection)
            ->paginate($entri);
        return view('user', compact('data', 'bid'));
    }

    public function resetFields()
    {
        $this->name = '';
        $this->username = '';
        $this->bidang = '';
    }

    public function create()
    {
        $this->resetFields();
        $this->resetValidation();
        $this->Mode = 'create';
    }

    public function store()
    {
        $this->resetValidation();
        $this->validate();
        $user = User::create([
            'name' => $this->name,
            'username' => $this->username,
            'bidang_id' => $this->bidang,
            'password' => Hash::make('12345'),
        ]);
        $user->assignRole('user');
        $this->Mode = 'index';
        $this->resetFields();
        $this->alert('success', 'User berhasil di buat!', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            'timerProgressBar' => true,
        ]);
    }

    public function edit($id)
    {
        $user = User::findOrFail(decrypt($id));
        $this->user_id = decrypt($id);
        $this->name = $user->name;
        $this->username = $user->username;
        $this->bidang = $user->bidang_id;
        $this->Mode = 'edit';
    }

    public function update()
    {
        $this->validate();
        $data = User::find($this->user_id);
        $data->update([
            'name' => $this->name,
            'username' => $this->username,
            'bidang_id' => $this->bidang
        ]);

        $this->Mode = 'index';
        $this->resetFields();
        $this->alert('success', 'Data berhasil diupdate!', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            'timerProgressBar' => true,
        ]);
    }

    public function passconfirm($id)
    {
        $this->pass_id = decrypt($id);
        $this->alert('warning', 'Konfirmasi Reset Password', [
            'position' => 'center',
            'timer' => null,
            'toast' => false,
            'text' => 'Apa anda yakin?',
            'iconHtml' => '<i
            class="far fa-trash-alt"></i>',
            'showConfirmButton' => true,
            'confirmButtonColor' => '#ff8103',
            'onConfirmed' => 'pass',
            'showCancelButton' => true,
            'onDismissed' => 'cancel',
            'confirmButtonText' => '<i class="bx bx-reset"></i> Ya, reset!',
            'cancelButtonText' => 'Cancel',
        ]);
    }

    public function pass()
    {
        $user = User::find($this->pass_id);
        $user->update([
            'password' => Hash::make('12345'),
        ]);

        $this->Mode = 'index';
        $this->resetFields();

        $this->alert('success', 'Password berhasil di reset!', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            'timerProgressBar' => true,
        ]);
    }

    public function delete($id)
    {
        $this->delete_id = decrypt($id);
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
        if (User::find($this->delete_id)->delete()) {
            $this->alert('success', 'berhasil di hapus!', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
                'timerProgressBar' => true,
            ]);
            $this->resetFields();
        } else {
            $this->alert('error', 'gagal di hapus!', [
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

