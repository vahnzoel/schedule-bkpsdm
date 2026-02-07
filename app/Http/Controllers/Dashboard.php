<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Bidang;
use App\Models\User;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $helper = new Helper;
        $tanggal = $helper->tanggal(date('Y-m-d'));
        $agenda = Agenda::count();
        $bidang = Bidang::count();
        $user = User::count();
        $data = Agenda::Where('tgl', date('Y-m-d'))
            ->orderby('created_at', 'DESC')
            ->paginate(10);
        return view('dashboard', compact('agenda', 'bidang', 'user', 'tanggal', 'data'));
    }
}
