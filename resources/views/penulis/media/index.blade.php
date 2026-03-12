@extends('layouts.dashboard')
@section('title', 'Media')
@section('page-title', 'Media (Foto & Video)')
@section('content')
    @include('partials.crud-index', [
        'title' => 'Media',
        'createRoute' => route('penulis.media.create'),
        'trashedRoute' => route('penulis.media.index'),
        'columns' => ['Preview', 'Nama File', 'Tipe', 'Ukuran', 'Tanggal Upload'],
        'paginator' => $media,
        'rows' => $media->map(function ($m) {
            if ($m->tipe === 'foto' && $m->file_path && !str_starts_with($m->file_path, 'http')) {
                $preview = new \Illuminate\Support\HtmlString(
                    '<img src="' . asset('storage/' . $m->file_path) . '" alt="' . e($m->judul) . '" class="w-16 h-12 object-cover border border-gray-200">'
                );
            } elseif ($m->tipe === 'video') {
                $ytId = e($m->file_name);
                $preview = new \Illuminate\Support\HtmlString(
                    '<div class="relative w-16 h-12 border border-gray-200 bg-black flex-shrink-0">' .
                        '<img src="https://img.youtube.com/vi/' . $ytId . '/default.jpg" alt="' . e($m->judul) . '" class="w-full h-full object-cover" onerror="this.style.display=&apos;none&apos;">' .
                        '<div class="absolute inset-0 flex items-center justify-center">' .
                            '<span class="text-red-500 text-lg"><i class="fab fa-youtube"></i></span>' .
                        '</div>' .
                    '</div>'
                );
            } else {
                $preview = new \Illuminate\Support\HtmlString(
                    '<span class="text-gray-300 text-xl"><i class="fas fa-image"></i></span>'
                );
            }
            return [
                'cells' => [
                    $preview,
                    $m->file_name,
                    ucfirst($m->tipe),
                    $m->formatted_size,
                    $m->created_at->format('d M Y'),
                ],
                'copyUrl' => $m->tipe === 'video'
                    ? 'https://www.youtube.com/watch?v=' . $m->file_name
                    : ($m->file_path ? asset('storage/' . $m->file_path) : null),
                'editRoute' => $m->trashed() ? null : route('penulis.media.edit', $m->id),
                'deleteRoute' => $m->trashed() ? null : route('penulis.media.destroy', $m->id),
                'restoreRoute' => $m->trashed() ? route('penulis.media.restore', $m->id) : null,
                'forceDeleteRoute' => $m->trashed() ? route('penulis.media.force-delete', $m->id) : null,
                'trashed' => $m->trashed(),
            ];
        })->toArray(),
    ])
@endsection
