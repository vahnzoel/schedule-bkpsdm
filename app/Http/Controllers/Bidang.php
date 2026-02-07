<?php

namespace App\Http\Controllers;

use App\Models\Bidang as B;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Bidang extends Component
{
    use WithFileUploads, WithPagination, WithoutUrlPagination, LivewireAlert;

    public $Mode = 'index';
    public $search = '';
    public $entries = '10';
    public $sortByColumn = 'nama';
    public $sortDirection = 'DESC';

    #[Validate('required', message: 'Nama Bidang harus diisi!')]
    public $nama;
    #[Validate('required', message: 'Singkatan harus diisi!')]
    public $singkatan;
    #[Validate('required', message: 'Warna Kalender harus dipilih!')]
    public $color;
    public $ket;
    public $bidang_id;
    public $delete_id;

    public function getListeners()
    {
        return [
            'destroy',
            'cancel',
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
        if (session('toast')) {
            $this->alert(session('toast')['type'], session('toast')['content'], [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
                'timerProgressBar' => true,
            ]);
        }
        if ($this->entries == 'all') {
            $entri = B::count();
        } else {
            $entri = $this->entries;
        }
        $search = $this->search;
        $data = B::search($search)
            ->orderby($this->sortByColumn, $this->sortDirection)
            ->paginate($entri);
        return view('bidang', compact('data'));
    }

    public function resetFields()
    {
        $this->nama = '';
        $this->singkatan = '';
        $this->ket = '';
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
        B::create([
            'nama' => $this->nama,
            'singkatan' => $this->singkatan,
            'color' => $this->color,
            'ket' => $this->ket,
            'user_id' => Auth::id()
        ]);

        session()->flash('toast', [
            'type' => 'success',
            'content' => 'Data berhasil ditambahkan!'
        ]);
        return $this->redirect('/bidang', navigate: true);
    }

    public function edit($id)
    {
        $data = B::findOrFail(decrypt($id));
        $this->bidang_id = decrypt($id);
        $this->nama = $data->nama;
        $this->singkatan = $data->singkatan;
        $this->color = $data->color;
        $this->ket = $data->ket;
        $this->Mode = 'edit';
    }

    public function update()
    {
        $this->validate();
        $data = B::find($this->bidang_id);
        $data->update([
            'nama' => $this->nama,
            'singkatan' => $this->singkatan,
            'color' => $this->color,
            'ket' => $this->ket,
        ]);

        session()->flash('toast', [
            'type' => 'success',
            'content' => 'Data berhasil diupdate!'
        ]);
        return $this->redirect('/bidang', navigate: true);
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
        if (B::find($this->delete_id)->delete()) {
            $this->alert('success', 'Data berhasil dihapus!', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
                'timerProgressBar' => true,
            ]);
            $this->resetFields();
        } else {
            $this->alert('error', 'Data gagal dihapus!', [
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

