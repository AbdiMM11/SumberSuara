<?php

namespace App\Http\Controllers\Audiens;

use App\Http\Controllers\Controller;
use App\Models\LaguFavorit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaguFavoritController extends Controller
{
    /**
     * Halaman playlist lagu favorit audience
     */
    public function index()
    {
        $user = Auth::user();

        // Kalau belum login -> kirim view playlist dengan koleksi kosong
        if (! $user) {
            $favorites = collect();
            return view('playlist', compact('favorites'));
        }

        // Kalau sudah login -> ambil daftar favorit
        $favorites = LaguFavorit::with(['karya.musisi.user'])
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        return view('playlist', compact('favorites'));
    }

    /**
     * Toggle lagu favorit (dipakai oleh tombol ❤️ di player)
     */
    public function toggle(Request $request)
    {
        $request->validate([
            'karya_id' => ['required', 'exists:karyas,id_karya'],
        ]);

        $user = $request->user();

        // ❌ Hanya izinkan role Audiens
        if (!$user || !$user->isAudiens()) {

            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'status'  => 'forbidden',
                    'title'   => 'Akses Ditolak',
                    'message' => 'Hanya akun Audiens yang dapat menambahkan lagu ke favorit.',
                ], 403);
            }

            return back()->with('status', 'Hanya akun Audiens yang dapat menambahkan lagu ke favorit.');
        }

        // ✅ Hanya Audiens yang sampai ke sini
        $favorite = LaguFavorit::where('user_id', $user->id)
            ->where('karya_id', $request->karya_id)
            ->first();

        $isFavorite = false;
        $title      = '';
        $message    = '';

        if ($favorite) {
            // UNLOVE
            $favorite->delete();
            $isFavorite = false;
            $title      = 'Dihapus dari Favorit';
            $message    = 'Lagu telah dihapus dari playlist favorit kamu.';
        } else {
            // LOVE
            LaguFavorit::create([
                'user_id'  => $user->id,
                'karya_id' => $request->karya_id,
            ]);
            $isFavorite = true;
            $title      = 'Ditambahkan ke Favorit';
            $message    = 'Lagu berhasil ditambahkan ke playlist favorit kamu.';
        }

        if ($request->wantsJson()) {
            return response()->json([
                'success'     => true,
                'status'      => 'ok',
                'title'       => $title,
                'message'     => $message,
                'is_favorite' => $isFavorite,
            ]);
        }

        return back()->with('status', $message);
    }
}
