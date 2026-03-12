@extends('layouts.dashboard')
@section('title', 'KDK — Kabar Dari Kampung')
@section('page-title', 'KDK — Kabar Dari Kampung')
@section('content')
    @include('partials.crud-index', [
        'title' => 'Edisi KDK',
        'createRoute' => route('penulis.kdk.create'),
        'trashedRoute' => route('penulis.kdk.index'),
        'columns' => ['Cover', 'Edisi', 'Judul', 'Tanggal Terbit', 'File PDF', 'Dibaca', 'Unduhan'],
        'paginator' => $kdk,
        'rows' => $kdk->map(fn ($k) => [
            'cells' => [
                $k->media && $k->media->file_path
                    ? new \Illuminate\Support\HtmlString(
                        '<img src="' . asset('storage/' . $k->media->file_path) . '" alt="' . e($k->judul) . '" class="w-12 h-16 object-cover border border-gray-200">'
                    )
                    : new \Illuminate\Support\HtmlString(
                        '<div class="w-12 h-16 bg-gray-100 border border-gray-200 flex items-center justify-center text-gray-300"><i class="fas fa-book text-lg"></i></div>'
                    ),
                new \Illuminate\Support\HtmlString(
                    '<span class="inline-block bg-primary text-white text-xs font-bold px-3 py-1">Edisi ' . e($k->nomor_edisi) . '</span>'
                ),
                $k->judul,
                $k->tanggal_terbit ? $k->tanggal_terbit->format('d M Y') : '-',
                $k->file_pdf
                    ? new \Illuminate\Support\HtmlString(
                        '<a href="' . route('kdk.download', $k->id) . '"
                            class="inline-flex items-center gap-1 text-primary text-sm hover:underline">
                            <i class="fas fa-file-pdf"></i> Unduh PDF
                        </a>'
                    )
                    : new \Illuminate\Support\HtmlString('<span class="text-gray-400 text-sm">—</span>'),
                new \Illuminate\Support\HtmlString(
                    '<span class="inline-flex items-center gap-1 text-gray-600"><i class="fas fa-eye text-sm"></i> ' . number_format($k->jumlah_dibaca ?? 0) . '</span>'
                ),
                new \Illuminate\Support\HtmlString(
                    '<span class="inline-flex items-center gap-1 text-gray-600"><i class="fas fa-download text-sm"></i> ' . number_format($k->jumlah_unduhan ?? 0) . '</span>'
                ),
            ],
            'editRoute'       => $k->trashed() ? null : route('penulis.kdk.edit', $k->id),
            'deleteRoute'     => $k->trashed() ? null : route('penulis.kdk.destroy', $k->id),
            'restoreRoute'    => $k->trashed() ? route('penulis.kdk.restore', $k->id) : null,
            'forceDeleteRoute'=> $k->trashed() ? route('penulis.kdk.force-delete', $k->id) : null,
            'trashed'         => $k->trashed(),
        ])->toArray(),
    ])
@endsection
