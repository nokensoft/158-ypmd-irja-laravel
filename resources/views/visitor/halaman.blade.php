@extends('layouts.visitor')
@section('title', $halaman->judul)
@section('seo-title', $halaman->judul)
@section('seo-description', $halaman->keterangan ?? '')
@php
    // Ekstrak gambar pertama dari konten HTML sebagai cover OG
    $_halamanImg = null;
    if (preg_match('/<img[^>]+src=["\']([^"\'>]+)["\']/', $halaman->konten ?? '', $_m)) {
        $_halamanImg = $_m[1];
        if (!str_starts_with($_halamanImg, 'http')) {
            $_halamanImg = asset($_halamanImg);
        }
    }
@endphp
@if ($_halamanImg)
    @section('seo-image', $_halamanImg)
@endif

@section('json-ld')
<script type="application/ld+json">{!! json_encode(['@context'=>'https://schema.org','@type'=>'BreadcrumbList','itemListElement'=>[['@type'=>'ListItem','position'=>1,'name'=>'Beranda','item'=>route('beranda')],['@type'=>'ListItem','position'=>2,'name'=>$halaman->judul]]], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>
@endsection

@section('content')
    @include('partials.section-header', [
        'headerTitle' => $halaman->judul,
        'headerSubtitle' => $halaman->keterangan ?? null,
        'headerBreadcrumb' => ' › ' . e($halaman->judul),
    ])

    {{-- Konten Halaman --}}
    {!! $halaman->konten !!}
@endsection
