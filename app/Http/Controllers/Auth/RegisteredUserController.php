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
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'min:6'], //'confirmed kalo pake pw confirmation
            'nis' => ['nullable', 'string', 'max:30', 'unique:'.User::class],
            'nip' => ['nullable', 'string', 'max:30', 'unique:'.User::class],
        ]);
        
        if (!$request->nis && !$request->nip) {
            return back()->withErrors([
                'nis' => 'Isi NIS atau NIP',
            ]);
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

        Auth::login($user);
        if ($user == 'siswa') {
            return redirect(route('dashboard-siswa', absolute: false));
        } else {
            return redirect(route('dashboard-guru', absolute: false));
        }
    }
}
