<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\AudiensWelcomeMail;
use App\Models\User;
use App\Models\Role;
use App\Models\Audiens;
use App\Models\Musisi;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Route GET /register (default Breeze)
     * Kita arahkan saja ke signup audiens.
     */
    public function create(): RedirectResponse
    {
        return redirect()->route('signup.audience');
    }

    /**
     * FORM REGISTER AUDIENS
     * GET /signup/audience
     */
    public function createAudience(): View
    {
        return view('auth.register-audience');
    }

    /**
     * PROSES REGISTER AUDIENS
     * POST /signup/audience
     */
    public function storeAudience(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email'    => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'gender'   => ['required', 'in:laki-laki,perempuan'],
            'age'      => ['required', 'integer', 'min:10', 'max:120'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Ambil role Audiens
        $roleAudiens = Role::where('nama_roles', 'Audiens')->firstOrFail();

        // Nama default = sebelum @
        $namaDefault = strstr($validated['email'], '@', true) ?: 'Audiens Sumber Suara';

        // Buat user audiens (langsung aktif)
        $user = new User();
        $user->nama        = $namaDefault;
        $user->email       = $validated['email'];
        $user->password    = Hash::make($validated['password']);
        $user->roles_id    = $roleAudiens->id;
        $user->foto_user   = null;
        $user->permissions = ['like_music', 'comment'];
        $user->is_active   = true;
        $user->save();

        // Mapping gender → jenis_kelamin
        $jenisKelamin = $validated['gender'] === 'laki-laki' ? 'L' : 'P';

        // Buat record audiens
        $audiens = Audiens::create([
            'user_id'       => $user->id,
            'umur'          => $validated['age'],
            'jenis_kelamin' => $jenisKelamin,
        ]);

        // Event standar (laravel register)
        event(new Registered($user));

        /**
         * ------------------------
         *  KIRIM EMAIL WELCOME
         * ------------------------
         */
        $jenisKelaminLabel = $jenisKelamin === 'L' ? 'Laki-laki' : 'Perempuan';

        Mail::to($user->email)->send(
            new AudiensWelcomeMail($user, $audiens->umur, $jenisKelaminLabel)
        );

        // Audiens langsung login
        Auth::login($user);

        return redirect()->route('index')
            ->with('success', 'Akun audiens berhasil dibuat, sudah aktif, dan email selamat datang telah dikirim.');
    }

    /**
     * FORM REGISTER MUSISI
     * GET /signup/musisi
     */
    public function createMusisi(): View
    {
        return view('auth.register-musisi');
    }

    /**
     * PROSES REGISTER MUSISI
     * POST /signup/musisi
     */
    public function storeMusisi(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email'                 => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'no_hp'                 => ['required', 'string', 'max:20'],
            'password'              => ['required', 'confirmed', Rules\Password::defaults()],
            'nama_band'             => ['required', 'string', 'max:255'],
            'genre'                 => ['required', 'string', 'max:60'],
            'domisili'              => ['required', 'string', 'max:60'],
            'file_mp3'              => ['required', 'file', 'mimes:mp3,ogg,wav', 'max:20480'],
            'spotify'               => ['nullable', 'string', 'max:255'],
            'instagram'             => ['nullable', 'string', 'max:255'],
            'youtube'               => ['nullable', 'string', 'max:255'],
        ]);

        // Role Musisi
        $roleMusisi = Role::where('nama_roles', 'Musisi')->firstOrFail();

        // Buat user (belum aktif)
        $user = new User();
        $user->nama        = $validated['nama_band'];
        $user->email       = $validated['email'];
        $user->password    = Hash::make($validated['password']);
        $user->roles_id    = $roleMusisi->id;
        $user->foto_user   = null;
        $user->permissions = ['upload_music', 'edit_profile'];
        $user->is_active   = false;
        $user->save();

        // Upload file MP3
        $filePath = $request->file('file_mp3')->store('musisi/original', 'public');

        // Buat record tabel musisi
        Musisi::create([
            'user_id'     => $user->id,
            'no_telp'     => $validated['no_hp'],
            'domisili'    => $validated['domisili'],
            'genre'       => $validated['genre'],
            'spotify'     => $validated['spotify']   ?? null,
            'instagram'   => $validated['instagram'] ?? null,
            'youtube'     => $validated['youtube']   ?? null,
            'file_mp3'    => $filePath,
            'status'      => 'pending',
            'approved_at' => null,
        ]);

        event(new Registered($user));

        return redirect()->route('index')
            ->with('success', 'Pendaftaran musisi berhasil dikirim. Akun Anda akan aktif setelah diverifikasi Admin.');
    }
}
