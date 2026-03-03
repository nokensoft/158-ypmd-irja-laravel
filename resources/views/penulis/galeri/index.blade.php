@extends('layouts.dashboard')
@section('title', 'Galeri')
@section('page-title', 'Galeri')
@section('content')
    @include('partials.crud-index', [
        'title' => 'Galeri',
        'createRoute' => route('penulis.galeri.create'),
        'trashedRoute' => route('penulis.galeri.index'),
        'columns' => ['Cover', 'Judul Album', 'Kategori', 'Jumlah Media', 'Tanggal'],
        'paginator' => $galeri,
        'rows' => $galeri->map(function ($g) {
            $cover = $g->media->first();
            if ($cover && $cover->file_path && !str_starts_with($cover->file_path, 'http')) {
                $preview = new \Illuminate\Support\HtmlString(
                    '<img src="' . asset('storage/' . $cover->file_path) . '" alt="' . e($g->judul) . '" class="w-16 h-12 object-cover border border-gray-200">'
                );
            } else {
                $preview = new \Illuminate\Support\HtmlString(
                    '<span class="text-gray-300 text-xl"><i class="fas fa-images"></i></span>'
                );
            }
            return [
                'cells' => [
                    $preview,
                    $g->judul,
                    $g->kategori ?? '-',
                    $g->media_count . ' media',
                    $g->created_at->format('d M Y'),
                ],
                'editRoute' => $g->trashed() ? null : route('penulis.galeri.edit', $g->id),
                'deleteRoute' => $g->trashed() ? null : route('penulis.galeri.destroy', $g->id),
                'restoreRoute' => $g->trashed() ? route('penulis.galeri.restore', $g->id) : null,
                'trashed' => $g->trashed(),
            ];
        })->toArray(),
    ])
@endsection
