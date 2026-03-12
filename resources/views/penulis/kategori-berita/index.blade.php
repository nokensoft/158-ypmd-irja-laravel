@extends('layouts.dashboard')
@section('title', 'Kategori Berita')
@section('page-title', 'Kategori Berita')
@section('content')
    @include('partials.crud-index', [
        'title' => 'Kategori',
        'createRoute' => route('penulis.kategori-berita.create'),
        'trashedRoute' => route('penulis.kategori-berita.index'),
        'columns' => ['Nama Kategori', 'Slug', 'Jumlah Berita'],
        'paginator' => $kategori,
        'rows' => $kategori->map(fn ($k) => [
            'cells' => [$k->nama, $k->slug, $k->berita_count],
            'editRoute' => $k->trashed() ? null : route('penulis.kategori-berita.edit', $k->id),
            'deleteRoute' => $k->trashed() ? null : route('penulis.kategori-berita.destroy', $k->id),
            'restoreRoute' => $k->trashed() ? route('penulis.kategori-berita.restore', $k->id) : null,
            'forceDeleteRoute' => $k->trashed() ? route('penulis.kategori-berita.force-delete', $k->id) : null,
            'trashed' => $k->trashed(),
        ])->toArray(),
    ])
@endsection
