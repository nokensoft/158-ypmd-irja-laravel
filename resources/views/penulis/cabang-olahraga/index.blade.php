@extends('layouts.dashboard')
@section('title', 'Cabang Olahraga')
@section('page-title', 'Cabang Olahraga')
@section('content')
    @include('partials.crud-index', [
        'title' => 'Cabor',
        'createRoute' => route('penulis.cabang-olahraga.create'),
        'trashedRoute' => route('penulis.cabang-olahraga.index'),
        'columns' => ['Nama', 'Icon', 'Jumlah Atlet', 'Medali'],
        'paginator' => $cabor,
        'rows' => $cabor->map(fn ($c) => [
            'cells' => [$c->nama, $c->icon ?? '-', $c->jumlah_atlet, $c->jumlah_medali],
            'editRoute' => $c->trashed() ? null : route('penulis.cabang-olahraga.edit', $c->id),
            'deleteRoute' => $c->trashed() ? null : route('penulis.cabang-olahraga.destroy', $c->id),
            'restoreRoute' => $c->trashed() ? route('penulis.cabang-olahraga.restore', $c->id) : null,
            'trashed' => $c->trashed(),
        ])->toArray(),
    ])
@endsection
