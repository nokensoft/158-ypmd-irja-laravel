@extends('layouts.dashboard')
@section('title', 'Kelola Pengguna')
@section('page-title', 'Kelola Pengguna')

@section('content')
    @include('partials.crud-index', [
        'title' => 'Pengguna',
        'createRoute' => route('admin.pengguna.create'),
        'trashedRoute' => route('admin.pengguna.index'),
        'columns' => ['Nama', 'Email', 'No. HP', 'Role', 'Status'],
        'paginator' => $pengguna,
        'rows' => $pengguna->map(fn ($p) => [
            'cells' => [
                $p->name,
                $p->email,
                $p->nomor_hp ?? '-',
                ucwords(str_replace('_', ' ', $p->role)),
                $p->trashed() ? '<span class="bg-red-100 text-red-700 px-2 py-1 text-sm font-bold">Terhapus</span>' : ($p->is_active ? '<span class="bg-green-100 text-green-700 px-2 py-1 text-sm font-bold">Aktif</span>' : '<span class="bg-yellow-100 text-yellow-700 px-2 py-1 text-sm font-bold">Nonaktif</span>'),
            ],
            'editRoute' => $p->trashed() ? null : route('admin.pengguna.edit', $p->id),
            'deleteRoute' => $p->trashed() ? null : route('admin.pengguna.destroy', $p->id),
            'restoreRoute' => $p->trashed() ? route('admin.pengguna.restore', $p->id) : null,
            'forceDeleteRoute' => $p->trashed() ? route('admin.pengguna.force-delete', $p->id) : null,
            'trashed' => $p->trashed(),
        ])->toArray(),
    ])
@endsection
