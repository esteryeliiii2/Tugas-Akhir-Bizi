<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'min:6'],
            'nis' => ['nullable', 'string', 'max:30', 'unique:users,nis'],
            'nip' => ['nullable', 'string', 'max:30', 'unique:users,nip'],
        ], [
            'nama.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah digunakan',
            'password.required' => 'Kata sandi wajib diisi',
            'password.min' => 'Kata sandi minimal 6 karakter',
            'nis.unique' => 'NIS sudah digunakan',
            'nip.unique' => 'NIP sudah digunakan',
        ]);

        if (empty($request->nis) && empty($request->nip)) {
            return back()->withErrors([
                'nis' => 'Silakan isi NIS atau NIP',
            ])->withInput();
        }

        $jabatan = $request->nis ? 'siswa' : 'guru umum';

        $user = User::create([
            'nama' => $request->nama,
            'nis' => $request->nis,
            'nip' => $request->nip,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'jabatan' => $jabatan,
        ]);

        event(new Registered($user));

        return redirect(route('login'));
        // Auth::login($user);
        // if ($user == 'siswa') {
        //     return redirect(route('dashboard-siswa', absolute: false));
        // } else {
        //     return redirect(route('dashboard-guru', absolute: false));
        // }
    }
}
