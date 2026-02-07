<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Logout extends Component
{
    use LivewireAlert;

    public function mount()
    {
        Auth::logout();
        $this->alert('warning', 'Anda telah logout!', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            'timerProgressBar' => true,
        ]);
        return $this->redirect('/login', navigate: true);
    }
}
