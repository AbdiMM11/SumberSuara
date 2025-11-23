<?php

namespace App\Http\Controllers\Musisi;

use App\Http\Controllers\Controller;
use App\Models\Karya;
use App\Models\LaguFavorit;
use App\Models\Audiens;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Pastikan hanya musisi yang bisa akses
        if (!$user || !$user->musisi) {
            abort(403, 'Dashboard ini hanya untuk akun Musisi.');
        }

        $musisi   = $user->musisi;
        $idMusisi = $musisi->id_musisi;

        /*
        |--------------------------------------------------------------------------
        | 1. TOTAL KARYA (LAGU) YANG DIUPLOAD OLEH MUSISI
        |--------------------------------------------------------------------------
        */
        $totalKarya = Karya::where('id_musisi', $idMusisi)->count();

        /*
        |--------------------------------------------------------------------------
        | 2. TOTAL LAGU YANG DI-LIKE (LAGU FAVORIT) OLEH AUDIENS
        |    -> Hitung jumlah record di lagu_favorit untuk semua karya milik musisi ini
        |--------------------------------------------------------------------------
        */
        $totalLikeLagu = LaguFavorit::whereHas('karya', function ($q) use ($idMusisi) {
            $q->where('id_musisi', $idMusisi);
        })->count();

        /*
        |--------------------------------------------------------------------------
        | 3 & 4. DATA AUDIENS YANG MENYUKAI LAGU (UNTUK CHART GENDER & UMUR)
        |    -> Cari audiens yang minimal menyukai 1 lagu milik musisi ini
        |--------------------------------------------------------------------------
        */
        $audiensLikes = Audiens::select('umur', 'jenis_kelamin')
            ->whereIn('user_id', function ($q) use ($idMusisi) {
                $q->select('lagu_favorit.user_id')
                    ->from('lagu_favorit')
                    ->join('karyas', 'lagu_favorit.karya_id', '=', 'karyas.id_karya')
                    ->where('karyas.id_musisi', $idMusisi)
                    ->distinct();
            })
            ->get();

        /*
        |--------------------------------------------------------------------------
        | 3. CHART GENDER AUDIENS
        |--------------------------------------------------------------------------
        */
        $genderLabels = ['Laki-laki', 'Perempuan'];
        $genderData   = [0, 0]; // index 0 = L, index 1 = P

        foreach ($audiensLikes as $aud) {
            if ($aud->jenis_kelamin === 'L') {
                $genderData[0]++;
            } elseif ($aud->jenis_kelamin === 'P') {
                $genderData[1]++;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | 4. CHART UMUR AUDIENS (BUCKET)
        |--------------------------------------------------------------------------
        */
        $umurBuckets = [
            '≤17'   => [null, 17],
            '18–24' => [18, 24],
            '25–34' => [25, 34],
            '35–44' => [35, 44],
            '≥45'   => [45, null],
        ];

        $umurLabels = array_keys($umurBuckets);
        $umurData   = array_fill(0, count($umurLabels), 0);

        foreach ($audiensLikes as $aud) {
            if ($aud->umur === null) {
                continue;
            }
            $umur = (int) $aud->umur;
            $i = 0;
            foreach ($umurBuckets as [$min, $max]) {
                $inRange = true;
                if (!is_null($min) && $umur < $min) $inRange = false;
                if (!is_null($max) && $umur > $max) $inRange = false;

                if ($inRange) {
                    $umurData[$i]++;
                    break;
                }
                $i++;
            }
        }

        return view('musisi.dashboard', [
            'totalKarya'    => $totalKarya,
            'totalLikeLagu' => $totalLikeLagu,
            'genderLabels'  => $genderLabels,
            'genderData'    => $genderData,
            'umurLabels'    => $umurLabels,
            'umurData'      => $umurData,
        ]);
    }
}
