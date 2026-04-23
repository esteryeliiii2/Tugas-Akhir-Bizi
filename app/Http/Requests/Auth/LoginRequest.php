<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'login' => ['required'],
            'password' => ['required'],
        ];
    }

    public function messages(): array
    {
        return [
            'login.required' => $this->input('login_type') === 'nip'
                ? 'NIP wajib diisi'
                : 'NIS wajib diisi',

            'password.required' => 'Kata sandi wajib diisi',
        ];
    }

    public function authenticate(): void
    {
        $loginType = $this->input('login_type'); // nis / nip

        if ($loginType === 'nip') {
            // LOGIN GURU
            if (! Auth::attempt([
                'nip' => $this->input('login'),
                'password' => $this->input('password'),
            ])) {
                throw ValidationException::withMessages([
                    'login' => 'NIP atau kata sandi salah',
                    'password' => 'NIP atau kata sandi salah',
                ]);
            }
        } else {
            // LOGIN SISWA
            if (! Auth::attempt([
                'nis' => $this->input('login'),
                'password' => $this->input('password'),
            ])) {
                throw ValidationException::withMessages([
                    'login' => 'NIS atau kata sandi salah',
                    'password' => 'NIS atau kata sandi salah',
                ]);
            }
        }
    }
}
