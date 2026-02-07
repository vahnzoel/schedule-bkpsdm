<?php

namespace App\Http\Controllers;

use App\Models\Agenda as Schedule;
use App\Models\Bidang;
use App\Models\User;
use DateTime;
use Exception;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Agenda extends Component
{
    use WithFileUploads, WithPagination, WithoutUrlPagination, LivewireAlert;

    public $Mode = 'index';
    public $search = '';
    public $entries = '10';
    public $sortByColumn = 'jam_mulai';
    public $sortDirection = 'ASC';
    public $past = false;

    #[Validate('required', message: 'Judul harus diisi!')]
    public $judul;
    public $tgl;
    #[Validate('required', message: 'Jam Mulai harus diisi!')]
    public $jam_mulai;
    #[Validate('required', message: 'Jam Selesai harus diisi!')]
    public $jam_selesai;
    #[Validate('required', message: 'Lokasi harus diisi!')]
    public $lokasi;
    public $bidang;
    #[Validate('required', message: 'Peserta harus dipilih!')]
    public $peserta;
    public $ket, $jam;
    public $agenda_id;
    public $delete_id;

    public function getListeners()
    {
        return [
            'destroy',
            'cancel',
        ];
    }

    public function updated($property)
    {
        if ($property === 'jam_mulai') {
            try {
                $startTime = new DateTime($this->jam_mulai);
                $endTime = new DateTime($this->jam_selesai);
                if ($endTime < $startTime) {
                    $this->jam_selesai = $this->jam_mulai;
                }
            } catch (Exception) {
                $this->jam_mulai = $this->jam_selesai;
            }
        }

        if ($property === 'jam_selesai') {
            try {
                $startTime = new DateTime($this->jam_mulai);
                $endTime = new DateTime($this->jam_selesai);
                if ($endTime < $startTime) {
                    $this->jam_mulai = $this->jam_selesai;
                }
            } catch (Exception) {
                $this->jam_selesai = $this->jam_mulai;
            }
        }
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
        $this->jam = '';
        $a = explode('T', $this->tgl);
        if (count($a) > 1) {
            $this->tgl = $a[0];
            $b = explode('+', $a[1]);
            $c = explode(':', $b[0]);
            $this->jam = $c[0] . ':' . $c[1];
        }
        $helper = new Helper;
        if ($this->entries == 'all') {
            $entri = Schedule::count();
        } else {
            $entri = $this->entries;
        }
        $search = $this->search;
        $data = Schedule::Where('tgl', $this->tgl)
            ->search($search)
            ->orderby($this->sortByColumn, $this->sortDirection)
            ->paginate($entri);
        $events = [];
        $a = Schedule::all();
        foreach ($a as $row) {
            $events[] = [
                'id' => $row->id,
                'title' => $row->judul . ' (' . $row->bidang . ')',
                'start' => date('Y-m-d', strtotime($row->tgl)) . 'T' . date('H:i:s', strtotime($row->jam_mulai)),
                'end' => date('Y-m-d', strtotime($row->tgl)) . 'T' . date('H:i:s', strtotime($row->jam_selesai)),
                'color' => $this->color($row->bidang),
            ];
        }
        return view('agenda', compact('data', 'helper', 'events'));
    }

    public function color($var)
    {
        $bidang = Bidang::Where('singkatan', $var)->first();
        return $bidang->color;
    }

    public function resetFields()
    {
        $this->judul = '';
        $this->jam_mulai = $this->jam;
        $this->jam_selesai = $this->jam;
        $this->lokasi = '';
        $this->bidang = '';
        $this->peserta = '';
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
        $user = User::find(Auth::id());
        $bidang = Bidang::find($user->bidang_id);
        Schedule::create([
            'judul' => strtoupper($this->judul),
            'tgl' => $this->tgl,
            'jam_mulai' => $this->jam_mulai,
            'jam_selesai' => $this->jam_selesai,
            'lokasi' => strtoupper($this->lokasi),
            'bidang' => $bidang->singkatan,
            'peserta' => strtoupper($this->peserta),
            'ket' => strtoupper($this->ket),
            'user_id' => Auth::id()
        ]);
        $this->Mode = 'table';
        $this->resetFields();
        $this->alert('success', 'Agenda berhasil dibuat!', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            'timerProgressBar' => true,
        ]);
    }

    public function edit($id)
    {
        $data = Schedule::findOrFail(decrypt($id));
        $this->agenda_id = $id;
        $this->judul = $data->judul;
        $this->tgl = $data->tgl;
        $this->jam_mulai = $data->jam_mulai;
        $this->jam_selesai = $data->jam_selesai;
        $this->lokasi = $data->lokasi;
        $this->bidang = $data->bidang;
        $this->peserta = $data->peserta;
        $this->ket = $data->ket;
        $this->Mode = 'edit';
    }

    public function update()
    {
        $this->validate();
        $data = Schedule::find($this->agenda_id);
        $data->update([
            'judul' => strtoupper($this->judul),
            'tgl' => $this->tgl,
            'jam_mulai' => $this->jam_mulai,
            'jam_selesai' => $this->jam_selesai,
            'lokasi' => strtoupper($this->lokasi),
            'peserta' => strtoupper($this->peserta),
            'ket' => strtoupper($this->ket),
        ]);

        $this->Mode = 'table';
        $this->resetFields();

        $this->alert('success', 'Agenda berhasil diupdate!', [
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
        if (Schedule::find($this->delete_id)->delete()) {
            $this->alert('success', 'Agenda berhasil dihapus!', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
                'timerProgressBar' => true,
            ]);
            $this->resetFields();
        } else {
            $this->alert('error', 'Agenda gagal dihapus!', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
                'timerProgressBar' => true,
            ]);
        }
    }

    public function cancel()
    {
        $this->Mode = 'table';
        $this->resetFields();
        $this->resetValidation();
    }
}
