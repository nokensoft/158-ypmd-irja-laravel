@extends('layouts.dashboard')
@section('title', 'Statistik Pengunjung')
@section('page-title', 'Statistik Pengunjung')

@section('content')
    {{-- Ringkasan --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        @foreach ([
            ['icon' => 'fa-eye', 'label' => 'Hari Ini', 'value' => $ringkasan['hari_ini'], 'color' => 'bg-blue-600'],
            ['icon' => 'fa-calendar', 'label' => 'Bulan Ini', 'value' => $ringkasan['bulan_ini'], 'color' => 'bg-green-600'],
            ['icon' => 'fa-users', 'label' => 'Total Pengunjung', 'value' => $ringkasan['total'], 'color' => 'bg-primary'],
            ['icon' => 'fa-newspaper', 'label' => 'Total Pembaca Berita', 'value' => $ringkasan['total_pembaca'], 'color' => 'bg-orange-500'],
        ] as $card)
            <div class="bg-white shadow-sm p-5">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 {{ $card['color'] }} text-white flex items-center justify-center flex-shrink-0">
                        <i class="fas {{ $card['icon'] }} text-lg"></i>
                    </div>
                    <div>
                        <p class="text-2xl font-extrabold text-dark">{{ number_format($card['value']) }}</p>
                        <p class="text-sm text-gray-500 uppercase font-bold">{{ $card['label'] }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Filter --}}
    <div class="bg-white shadow-sm p-6">
        <div class="flex flex-wrap gap-2 mb-6">
            @foreach ([
                'harian' => 'Harian',
                'mingguan' => 'Mingguan',
                'bulanan' => 'Bulanan',
                'tahunan' => 'Tahunan',
            ] as $key => $label)
                <a href="?filter={{ $key }}"
                   class="px-5 py-2 text-sm font-bold uppercase tracking-wide transition no-round {{ $filter === $key ? 'bg-primary text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    {{ $label }}
                </a>
            @endforeach
        </div>

        <h3 class="text-lg font-extrabold text-dark uppercase mb-4">{{ $data['label'] }}</h3>

        @if (count($data['rows']) > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-gray-50 border-b-2 border-gray-200">
                            <th class="px-4 py-3 text-sm font-bold uppercase text-gray-500 w-16">No</th>
                            @foreach ($data['kolom'] as $kolom)
                                <th class="px-4 py-3 text-sm font-bold uppercase text-gray-500">{{ $kolom }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['rows'] as $i => $row)
                            <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                                <td class="px-4 py-3 text-base text-gray-500">{{ $i + 1 }}</td>
                                <td class="px-4 py-3 text-base font-medium">{{ $row['periode'] }}</td>
                                @if (isset($row['rentang']))
                                    <td class="px-4 py-3 text-base text-gray-500">{{ $row['rentang'] }}</td>
                                @endif
                                <td class="px-4 py-3 text-base font-bold text-primary">{{ number_format($row['jumlah']) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="bg-gray-50 border-t-2 border-gray-200">
                            <td class="px-4 py-3 text-base font-bold uppercase" colspan="{{ count($data['kolom']) }}">Total</td>
                            <td class="px-4 py-3 text-base font-extrabold text-primary">{{ number_format(array_sum(array_column($data['rows'], 'jumlah'))) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        @else
            <div class="text-center py-12 text-gray-400">
                <i class="fas fa-chart-bar text-4xl mb-3"></i>
                <p class="text-base font-bold">Belum ada data pengunjung</p>
            </div>
        @endif
    </div>
@endsection
