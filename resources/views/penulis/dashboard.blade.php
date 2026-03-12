@extends('layouts.dashboard')
@section('title', 'Dasbor Penulis')
@section('page-title', 'Dasbor')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        @foreach ($stats as $stat)
            <div class="bg-white shadow-sm p-6 flex items-center space-x-4">
                <div class="w-14 h-14 {{ $stat['color'] }} text-white flex items-center justify-center shrink-0">
                    <i class="fas {{ $stat['icon'] }} text-xl"></i>
                </div>
                <div>
                    <p class="text-3xl font-extrabold text-dark">{{ $stat['value'] }}</p>
                    <p class="text-base text-gray-500">{{ $stat['label'] }}</p>
                </div>
            </div>
        @endforeach
    </div>

    <div class="bg-white shadow-sm p-6">
        <h3 class="text-lg font-bold uppercase mb-4 pb-3 border-b border-primary">Berita Terbaru</h3>
        @if ($beritaTerbaru->count() > 0)
            <div class="space-y-0">
                @foreach ($beritaTerbaru as $b)
                    <div class="flex justify-between items-center py-3 border-b border-gray-100">
                        <div class="flex-1 min-w-0 mr-4">
                            <p class="text-base font-medium truncate">{{ $b->judul }}</p>
                            <p class="text-sm text-gray-400">{{ $b->kategori?->nama ?? '-' }} &middot; {{ $b->created_at->format('d M Y') }}</p>
                        </div>
                        <span class="text-sm font-bold px-3 py-1 shrink-0 {{ $b->status === 'terbit' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">{{ ucfirst($b->status) }}</span>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-400 text-center py-4">Belum ada berita. <a href="{{ route('penulis.berita.create') }}" class="text-primary underline">Tulis berita pertama</a></p>
        @endif
    </div>
@endsection
