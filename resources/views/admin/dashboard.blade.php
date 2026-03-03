@extends('layouts.dashboard')
@section('title', 'Dasbor Admin')
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

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white shadow-sm p-6">
            <h3 class="text-lg font-bold uppercase mb-4 pb-3 border-b border-primary">Aktivitas Login Terbaru</h3>
            @if ($loginTerbaru->count() > 0)
                <div class="space-y-0">
                    @foreach ($loginTerbaru as $log)
                        <div class="flex justify-between items-center py-3 border-b border-gray-100">
                            <div>
                                <p class="text-base font-medium">{{ $log->user?->name ?? $log->email }}</p>
                                <p class="text-sm text-gray-400">{{ $log->created_at->diffForHumans() }}</p>
                            </div>
                            <span class="text-sm font-bold px-3 py-1 {{ $log->status === 'berhasil' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">{{ ucfirst($log->status) }}</span>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-400 text-center py-4">Belum ada aktivitas login.</p>
            @endif
        </div>
        <div class="bg-white shadow-sm p-6">
            <h3 class="text-lg font-bold uppercase mb-4 pb-3 border-b border-primary">Info Sistem</h3>
            <div class="space-y-0 text-base">
                <div class="flex justify-between py-3 border-b border-gray-100"><span class="text-gray-500">Versi Laravel</span><span class="font-bold">{{ $sistem['laravel'] }}</span></div>
                <div class="flex justify-between py-3 border-b border-gray-100"><span class="text-gray-500">Versi PHP</span><span class="font-bold">{{ $sistem['php'] }}</span></div>
                <div class="flex justify-between py-3 border-b border-gray-100"><span class="text-gray-500">Database</span><span class="font-bold">{{ $sistem['database'] }}</span></div>
                <div class="flex justify-between py-3"><span class="text-gray-500">Status</span><span class="font-bold text-green-600"><i class="fas fa-circle text-xs mr-1"></i> Online</span></div>
            </div>
        </div>
    </div>
@endsection
