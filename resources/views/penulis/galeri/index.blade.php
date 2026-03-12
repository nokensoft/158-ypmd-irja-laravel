@extends('layouts.dashboard')
@section('title', 'Galeri')
@section('page-title', 'Galeri')
@section('content')
    @include('partials.crud-index', [
        'title' => 'Galeri',
        'createRoute' => route('penulis.galeri.create'),
        'trashedRoute' => route('penulis.galeri.index'),
        'columns' => ['Cover', 'Judul Album', 'Kategori', 'Jumlah Media', 'Publik', 'Tanggal'],
        'paginator' => $galeri,
        'rows' => $galeri->map(function ($g) {
            $cover = $g->media->first();
            if ($cover && $cover->tipe === 'video') {
                $preview = new \Illuminate\Support\HtmlString(
                    '<img src="https://img.youtube.com/vi/' . e($cover->file_name) . '/default.jpg" alt="' . e($g->judul) . '" class="w-16 h-12 object-cover border border-gray-200" onerror="this.outerHTML=\'<span class=&quot;text-gray-400 text-xl&quot;><i class=&quot;fab fa-youtube&quot;></i></span>\'">' .
                    '<span class="absolute bottom-0 right-0 bg-red-600 text-white text-[8px] px-1"><i class="fab fa-youtube"></i></span>'
                );
            } elseif ($cover && $cover->file_path && !str_starts_with($cover->file_path, 'http')) {
                $preview = new \Illuminate\Support\HtmlString(
                    '<img src="' . asset('storage/' . $cover->file_path) . '" alt="' . e($g->judul) . '" class="w-16 h-12 object-cover border border-gray-200">'
                );
            } else {
                $preview = new \Illuminate\Support\HtmlString(
                    '<span class="text-gray-300 text-xl"><i class="fas fa-images"></i></span>'
                );
            }

            if ($g->trashed()) {
                $publikCell = new \Illuminate\Support\HtmlString(
                    '<span class="text-gray-300"><i class="fas fa-minus text-xs"></i></span>'
                );
            } else {
                $publikCell = new \Illuminate\Support\HtmlString(
                    '<form action="' . route('penulis.galeri.toggle-publik', $g->id) . '" method="POST" class="inline">' .
                    csrf_field() . method_field('PATCH') .
                    '<button type="submit" title="' . ($g->is_publik ? 'Sembunyikan dari publik' : 'Tampilkan di publik') . '"' .
                    ' class="inline-flex items-center justify-center w-8 h-8 transition ' .
                    ($g->is_publik ? 'bg-green-50 text-green-600 hover:bg-green-100' : 'bg-gray-100 text-gray-400 hover:bg-gray-200') . '">' .
                    '<i class="fas ' . ($g->is_publik ? 'fa-eye' : 'fa-eye-slash') . ' text-sm"></i>' .
                    '</button></form>'
                );
            }

            return [
                'cells' => [
                    $preview,
                    $g->judul,
                    $g->kategori ?? '-',
                    $g->media_count . ' media',
                    $publikCell,
                    $g->created_at->format('d M Y'),
                ],
                'editRoute' => $g->trashed() ? null : route('penulis.galeri.edit', $g->id),
                'deleteRoute' => $g->trashed() ? null : route('penulis.galeri.destroy', $g->id),
                'restoreRoute' => $g->trashed() ? route('penulis.galeri.restore', $g->id) : null,
                'forceDeleteRoute' => $g->trashed() ? route('penulis.galeri.force-delete', $g->id) : null,
                'trashed' => $g->trashed(),
            ];
        })->toArray(),
    ])
@endsection
