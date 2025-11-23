<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use App\Models\Audiens;
use App\Models\Event;
use App\Models\Karya;
use App\Models\Musisi;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | 1. STATISTIK TOTAL
        |--------------------------------------------------------------------------
        */

        $totalMusisi  = Musisi::count();
        $totalAudiens = Audiens::count();
        $totalEvent   = Event::count();

        $totalArtikel     = Artikel::count();
        $artikelPublished = Artikel::published()->count();
        $artikelDraft     = Artikel::whereNull('published_at')->count();

        $totalLagu = Karya::count();

        /*
        |--------------------------------------------------------------------------
        | 2. CHART AUDIENS: FREKUENSI UMUR & JENIS KELAMIN
        |--------------------------------------------------------------------------
        */

        $buckets = [
            '≤17'   => ['min' => null, 'max' => 17],
            '18–24' => ['min' => 18,   'max' => 24],
            '25–34' => ['min' => 25,   'max' => 34],
            '35–44' => ['min' => 35,   'max' => 44],
            '≥45'   => ['min' => 45,   'max' => null],
        ];

        $umurGenderData = [];
        foreach ($buckets as $label => $range) {
            $umurGenderData[$label] = ['L' => 0, 'P' => 0];
        }

        $allAudiens = Audiens::select('umur', 'jenis_kelamin')->get();

        foreach ($allAudiens as $audien) {
            $umur = $audien->umur;
            $jk   = $audien->jenis_kelamin; // 'L' atau 'P'

            if ($umur === null || !in_array($jk, ['L', 'P'])) {
                continue;
            }

            foreach ($buckets as $label => $range) {
                $min = $range['min'];
                $max = $range['max'];

                $inRange = true;
                if (!is_null($min) && $umur < $min) $inRange = false;
                if (!is_null($max) && $umur > $max) $inRange = false;

                if ($inRange) {
                    $umurGenderData[$label][$jk]++;
                    break;
                }
            }
        }

        $umurLabels = array_keys($buckets);
        $umurDataLaki = array_map(
            'intval',
            array_map(fn ($label) => $umurGenderData[$label]['L'], $umurLabels)
        );
        $umurDataPerempuan = array_map(
            'intval',
            array_map(fn ($label) => $umurGenderData[$label]['P'], $umurLabels)
        );

        /*
        |--------------------------------------------------------------------------
        | 3. STATISTIK PENDAFTAR per BULAN (Musisi & Audiens)
        |--------------------------------------------------------------------------
        */

        $startMonth = now()->subMonths(5)->startOfMonth();
        $endMonth   = now()->endOfMonth();

        $musisiPerBulan = Musisi::whereBetween('created_at', [$startMonth, $endMonth])
            ->select(
                DB::raw('DATE_FORMAT(created_at, "%Y-%m") as bulan'),
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('bulan')
            ->pluck('total', 'bulan'); // ['2025-07' => 5, ...]

        $audiensPerBulan = Audiens::whereBetween('created_at', [$startMonth, $endMonth])
            ->select(
                DB::raw('DATE_FORMAT(created_at, "%Y-%m") as bulan'),
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('bulan')
            ->pluck('total', 'bulan');

        $bulanLabels          = [];
        $pendaftarMusisiData  = [];
        $pendaftarAudiensData = [];

        $period = new \DatePeriod(
            $startMonth,
            new \DateInterval('P1M'),
            $endMonth->copy()->addMonth()->startOfMonth()
        );

        /** @var Carbon $month */
        foreach ($period as $month) {
            $key   = $month->format('Y-m');
            $label = $month->format('M Y');

            $bulanLabels[]          = $label;
            $pendaftarMusisiData[]  = $musisiPerBulan[$key]  ?? 0;
            $pendaftarAudiensData[] = $audiensPerBulan[$key] ?? 0;
        }

        // 🔐 PENTING: pastikan semua nilai numeric sebelum dipakai di view
        $pendaftarMusisiData   = array_map('intval', $pendaftarMusisiData);
        $pendaftarAudiensData  = array_map('intval', $pendaftarAudiensData);

        /*
        |--------------------------------------------------------------------------
        | RETURN KE VIEW
        |--------------------------------------------------------------------------
        */

        return view('admin.dashboard', [
            'totalMusisi'          => $totalMusisi,
            'totalAudiens'         => $totalAudiens,
            'totalEvent'           => $totalEvent,
            'totalArtikel'         => $totalArtikel,
            'totalLagu'            => $totalLagu,
            'artikelPublished'     => $artikelPublished,
            'artikelDraft'         => $artikelDraft,

            'umurLabels'           => $umurLabels,
            'umurDataLaki'         => $umurDataLaki,
            'umurDataPerempuan'    => $umurDataPerempuan,

            'bulanLabels'          => $bulanLabels,
            'pendaftarMusisiData'  => $pendaftarMusisiData,
            'pendaftarAudiensData' => $pendaftarAudiensData,
        ]);
    }
}
