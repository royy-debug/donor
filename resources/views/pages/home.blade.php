@extends('layouts.app')

@section('title', 'Home | Blood Donor')

@push('styles')
  <!-- Tambah style khusus halaman di sini -->
@endpush

@section('content')
  @include('partials.hero')
  @include('partials.blood-stock', ['stok' => $stok])
  @include('partials.education')
  @include('partials.latest-info')
  @include('partials.about-us')
@endsection

@push('scripts')
  <!-- Script Chart.js, AOS, Swiper, dll., bisa diletakkan di partial masing-masing atau di sini -->
@endpush
