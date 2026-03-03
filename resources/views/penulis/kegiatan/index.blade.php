@extends('layouts.dashboard')
@section('title', 'Kegiatan')
@section('page-title', 'Kegiatan')
@section('content')
    @include('partials.crud-index', [
        'title' => 'Kegiatan',
        'createRoute' => route('penulis.kegiatan.create'),
        'trashedRoute' => route('penulis.kegiatan.index'),
        'columns' => ['Judul', 'Tanggal', 'Lokasi'],
        'paginator' => $kegiatan,
        'rows' => $kegiatan->map(fn ($k) => [
            'cells' => [
                $k->judul,
                $k->tanggal_mulai->format('d M Y') . ($k->tanggal_selesai ? ' - ' . $k->tanggal_selesai->format('d M Y') : ''),
                $k->lokasi ?? '-',
            ],
            'editRoute' => $k->trashed() ? null : route('penulis.kegiatan.edit', $k->id),
            'deleteRoute' => $k->trashed() ? null : route('penulis.kegiatan.destroy', $k->id),
            'restoreRoute' => $k->trashed() ? route('penulis.kegiatan.restore', $k->id) : null,
            'trashed' => $k->trashed(),
        ])->toArray(),
    ])
@endsection
