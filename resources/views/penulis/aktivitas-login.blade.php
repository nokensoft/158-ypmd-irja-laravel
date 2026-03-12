@extends('layouts.dashboard')
@section('title', 'Aktivitas Login Penulis')
@section('page-title', 'Aktivitas Login Penulis')

@section('content')
    @include('partials.crud-index', [
        'title' => 'Aktivitas',
        'hideActions' => true,
        'columns' => ['Pengguna', 'Email', 'IP Address', 'Waktu', 'Status'],
        'paginator' => $aktivitas,
        'rows' => $aktivitas->map(fn ($a) => [
            'cells' => [
                $a->nama ?? 'Unknown',
                $a->email,
                $a->ip_address ?? '-',
                $a->created_at->format('d M Y H:i'),
                ucfirst($a->status),
            ],
        ])->toArray(),
    ])
@endsection
