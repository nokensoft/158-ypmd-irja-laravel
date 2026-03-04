<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\KunjunganSitus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatistikPengunjungController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->get('filter', 'harian');

        $data = match ($filter) {
            'mingguan' => $this->mingguan(),
            'bulanan' => $this->bulanan(),
            'tahunan' => $this->tahunan(),
            default => $this->harian(),
        };

        $ringkasan = [
            'hari_ini' => KunjunganSitus::where('tanggal', today())->count(),
            'bulan_ini' => KunjunganSitus::whereMonth('tanggal', now()->month)
                ->whereYear('tanggal', now()->year)->count(),
            'total' => KunjunganSitus::count(),
            'total_pembaca' => (int) Berita::sum('jumlah_dibaca'),
        ];

        return view('admin.statistik-pengunjung', compact('data', 'filter', 'ringkasan'));
    }

    /**
     * Per hari (hari ini = 7 hari terakhir)
     */
    private function harian(): array
    {
        $rows = KunjunganSitus::select(
                DB::raw('tanggal'),
                DB::raw('COUNT(*) as jumlah')
            )
            ->where('tanggal', '>=', now()->subDays(6)->toDateString())
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        return [
            'label' => 'Harian (7 Hari Terakhir)',
            'kolom' => ['Tanggal', 'Jumlah Pengunjung'],
            'rows' => $rows->map(fn ($r) => [
                'periode' => \Carbon\Carbon::parse($r->tanggal)->translatedFormat('l, d M Y'),
                'jumlah' => $r->jumlah,
            ])->toArray(),
        ];
    }

    /**
     * Per minggu (setiap hari dalam minggu ini)
     */
    private function mingguan(): array
    {
        $startOfWeek = now()->startOfWeek();
        $endOfWeek = now()->endOfWeek();

        $rows = KunjunganSitus::select(
                DB::raw('tanggal'),
                DB::raw('COUNT(*) as jumlah')
            )
            ->whereBetween('tanggal', [$startOfWeek->toDateString(), $endOfWeek->toDateString()])
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        return [
            'label' => 'Mingguan (' . $startOfWeek->translatedFormat('d M') . ' - ' . $endOfWeek->translatedFormat('d M Y') . ')',
            'kolom' => ['Hari', 'Jumlah Pengunjung'],
            'rows' => $rows->map(fn ($r) => [
                'periode' => \Carbon\Carbon::parse($r->tanggal)->translatedFormat('l, d M Y'),
                'jumlah' => $r->jumlah,
            ])->toArray(),
        ];
    }

    /**
     * Per bulan (setiap minggu dalam bulan ini)
     */
    private function bulanan(): array
    {
        $startOfMonth = now()->startOfMonth();
        $endOfMonth = now()->endOfMonth();

        $rows = KunjunganSitus::select(
                DB::raw('MIN(tanggal) as tanggal_awal'),
                DB::raw('MAX(tanggal) as tanggal_akhir'),
                DB::raw('WEEK(tanggal, 1) as minggu'),
                DB::raw('COUNT(*) as jumlah')
            )
            ->whereBetween('tanggal', [$startOfMonth->toDateString(), $endOfMonth->toDateString()])
            ->groupBy(DB::raw('WEEK(tanggal, 1)'))
            ->orderBy('minggu')
            ->get();

        $weekNum = 1;

        return [
            'label' => 'Bulanan (' . $startOfMonth->translatedFormat('F Y') . ')',
            'kolom' => ['Minggu', 'Periode', 'Jumlah Pengunjung'],
            'rows' => $rows->map(function ($r) use (&$weekNum) {
                $awal = \Carbon\Carbon::parse($r->tanggal_awal)->translatedFormat('d M');
                $akhir = \Carbon\Carbon::parse($r->tanggal_akhir)->translatedFormat('d M');
                return [
                    'periode' => 'Minggu ' . $weekNum++,
                    'rentang' => $awal . ' - ' . $akhir,
                    'jumlah' => $r->jumlah,
                ];
            })->toArray(),
        ];
    }

    /**
     * Per tahun (setiap bulan dalam tahun ini)
     */
    private function tahunan(): array
    {
        $rows = KunjunganSitus::select(
                DB::raw('MONTH(tanggal) as bulan'),
                DB::raw('COUNT(*) as jumlah')
            )
            ->whereYear('tanggal', now()->year)
            ->groupBy(DB::raw('MONTH(tanggal)'))
            ->orderBy('bulan')
            ->get();

        return [
            'label' => 'Tahunan (' . now()->year . ')',
            'kolom' => ['Bulan', 'Jumlah Pengunjung'],
            'rows' => $rows->map(fn ($r) => [
                'periode' => \Carbon\Carbon::create(now()->year, $r->bulan, 1)->translatedFormat('F'),
                'jumlah' => $r->jumlah,
            ])->toArray(),
        ];
    }
}
