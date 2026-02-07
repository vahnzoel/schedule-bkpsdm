<?php

namespace App\Http\Controllers\Auth;

use App\Models\User as users;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Password extends Component
{
    use LivewireAlert;

    #[Validate('required', message: 'Password Lama harus diisi!')]
    public $password_lama;
    #[Validate('required', message: 'Password Baru harus diisi!')]
    public $password_baru;

    public function render()
    {
        return view('auth.password');
    }

    public function resetFields()
    {
        $this->password_lama = '';
        $this->password_baru = '';
    }

    public function password()
    {
        $this->validate();
        $user = users::find(Auth::id());
        if (Hash::check($this->password_lama, $user->password)) {
            if ($user->update([
                'password' => Hash::make($this->password_baru),
            ])) {
                $this->alert('success', 'Password berhasil di update!', [
                    'position' => 'top-end',
                    'timer' => 3000,
                    'toast' => true,
                    'timerProgressBar' => true,
                ]);
                $this->resetFields();

                return $this->redirect('/', navigate: true);
            }
        } else {
            $this->alert('error', 'Password salah!', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
                'timerProgressBar' => true,
            ]);
        }
    }
}
