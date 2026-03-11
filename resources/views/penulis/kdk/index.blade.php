@extends('layouts.dashboard')
@section('title', 'KDK — Kabar Dari Kampung')
@section('page-title', 'KDK — Kabar Dari Kampung')
@section('content')
    @include('partials.crud-index', [
        'title' => 'Edisi KDK',
        'createRoute' => route('penulis.kdk.create'),
        'trashedRoute' => route('penulis.kdk.index'),
        'columns' => ['Edisi', 'Judul', 'Tanggal Terbit', 'File PDF'],
        'paginator' => $kdk,
        'rows' => $kdk->map(fn ($k) => [
            'cells' => [
                new \Illuminate\Support\HtmlString(
                    '<span class="inline-block bg-primary text-white text-xs font-bold px-3 py-1">Edisi ' . e($k->nomor_edisi) . '</span>'
                ),
                $k->judul,
                $k->tanggal_terbit ? $k->tanggal_terbit->format('d M Y') : '-',
                $k->file_pdf
                    ? new \Illuminate\Support\HtmlString(
                        '<a href="' . asset('storage/' . $k->file_pdf) . '" target="_blank"
                            class="inline-flex items-center gap-1 text-primary text-sm hover:underline">
                            <i class="fas fa-file-pdf"></i> Unduh PDF
                        </a>'
                    )
                    : new \Illuminate\Support\HtmlString('<span class="text-gray-400 text-sm">—</span>'),
            ],
            'editRoute'    => $k->trashed() ? null : route('penulis.kdk.edit', $k->id),
            'deleteRoute'  => $k->trashed() ? null : route('penulis.kdk.destroy', $k->id),
            'restoreRoute' => $k->trashed() ? route('penulis.kdk.restore', $k->id) : null,
            'trashed'      => $k->trashed(),
        ])->toArray(),
    ])
@endsection
