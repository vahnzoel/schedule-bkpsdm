<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Login extends Component
{
    use LivewireAlert;

    #[Validate('required', message: 'Username harus diisi!')]
    public $username;
    #[Validate('required', message: 'Password harus diisi!')]
    public $password;

    #[Layout('layouts.login')]
    public function render()
    {
        return view('auth.login');
    }

    public function auth()
    {
        $this->validate();
        if (Auth::attempt(['username' => $this->username, 'password' => $this->password])) {
            $this->username = '';
            $this->password = '';
            $this->resetValidation();
            $this->alert('success', 'Login Berhasil!', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
                'timerProgressBar' => true,
            ]);
            if (User::find(Auth::id())->hasrole('pppk') == true) {
            return $this->redirect('/pppk', navigate: true);
            } else {
                return $this->redirect('/', navigate: true);
            }
        } else {
            $this->alert('error', 'Username atau Password salah!', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
                'timerProgressBar' => true,
            ]);
            $this->username = '';
            $this->password = '';
            $this->resetValidation();
        }
    }
}
