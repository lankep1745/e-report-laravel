<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.guest')]
#[Title('Masuk ke Akun - E-Report Civic')]
class Login extends Component
{
    public string $email = '';
    public string $password = '';
    public bool $remember = false;

    protected function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    protected function messages(): array
    {
        return [
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format alamat email tidak valid.',
            'password.required' => 'Kata sandi wajib diisi.',
        ];
    }

    public function login()
    {
        $this->validate();

        if (!Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            throw ValidationException::withMessages([
                'email' => 'Kombinasi email dan kata sandi tidak cocok dengan data kami.',
            ]);
        }

        session()->regenerate();

        $user = Auth::user();

        if ($user->role === 'admin') {
            return $this->redirect(route('admin.dashboard'), navigate: true);
        }

        return $this->redirect(route('warga.dashboard'), navigate: true);
    }

    public function fillAdminCredentials()
    {
        $this->email = 'admin@ereport.test';
        $this->password = 'password123';
    }

    public function fillWargaCredentials()
    {
        $this->email = 'lana@ereport.test';
        $this->password = 'password123';
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
