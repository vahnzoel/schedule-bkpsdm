<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Livewire\Component;

class Kalender extends Component
{
    public function render()
    {
        $events = [];
        $a = Agenda::all();
        foreach ($a as $row) {
            $events[] = [
                'title' => $row->judul . ' (Bidang ' . $row->bidang . ')',
                'start' => date('Y-m-d', strtotime($row->tgl)) . 'T' . date('H:i:s', strtotime($row->jam_mulai)),
                'end' => date('Y-m-d', strtotime($row->tgl)) . 'T' . date('H:i:s', strtotime($row->jam_selesai)),
                'color' => $this->color($row->bidang),
            ];
        }
        return view('kalender', compact('events'));
    }
}
