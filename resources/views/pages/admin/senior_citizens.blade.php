@extends('layouts.admin_shell')

@section('title', 'Senior Citizens')
@section('page_title', 'Senior Citizens')
@section('page_subtitle', 'Registered persons aged 60 years old and above')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin_senior_citizens.css') }}">
@endpush

@section('content')

@include('livewire.admin.senior-citizens')

@endsection