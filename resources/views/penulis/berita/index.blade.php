@extends('layouts.dashboard')
@section('title', 'Papua Today')
@section('page-title', 'Papua Today')
@section('content')
    @include('partials.crud-index', [
        'title' => 'Berita',
        'createRoute' => route('penulis.berita.create'),
        'trashedRoute' => route('penulis.berita.index'),
        'columns' => ['Gambar', 'Judul', 'Kategori', 'Tanggal', 'Status', 'Dibaca'],
        'paginator' => $berita,
        'rows' => $berita->map(function ($b) {
            $media = $b->media;
            if ($media && $media->tipe === 'foto' && $media->file_path && !str_starts_with($media->file_path, 'http')) {
                $preview = new \Illuminate\Support\HtmlString(
                    '<img src="' . asset('storage/' . $media->file_path) . '" alt="' . e($b->judul) . '" class="w-16 h-12 object-cover border border-gray-200">'
                );
            } elseif ($b->gambar_url) {
                $preview = new \Illuminate\Support\HtmlString(
                    '<img src="' . e($b->gambar_url) . '" alt="' . e($b->judul) . '" class="w-16 h-12 object-cover border border-gray-200">'
                );
            } else {
                $preview = new \Illuminate\Support\HtmlString(
                    '<span class="text-gray-300 text-xl"><i class="fas fa-newspaper"></i></span>'
                );
            }
            return [
                'cells' => [
                    $preview,
                    $b->judul,
                    $b->kategori?->nama ?? '-',
                    $b->created_at->format('d M Y'),
                    ucfirst($b->status),
                    new \Illuminate\Support\HtmlString(
                        '<span class="inline-flex items-center gap-1 text-gray-600"><i class="fas fa-eye text-sm"></i> ' . number_format($b->jumlah_dibaca ?? 0) . '</span>'
                    ),
                ],
                'editRoute' => $b->trashed() ? null : route('penulis.berita.edit', $b->id),
                'deleteRoute' => $b->trashed() ? null : route('penulis.berita.destroy', $b->id),
                'restoreRoute' => $b->trashed() ? route('penulis.berita.restore', $b->id) : null,
                'forceDeleteRoute' => $b->trashed() ? route('penulis.berita.force-delete', $b->id) : null,
                'trashed' => $b->trashed(),
            ];
        })->toArray(),
    ])
@endsection
