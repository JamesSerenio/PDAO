@extends('layouts.admin')

@section('title','Senior Citizens')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin_senior_citizens.css') }}">
@endpush

@section('page_title','Senior Citizens')
@section('page_subtitle','List of registered persons aged 60 and above')

@section('content')

<div class="senior-container">

    <h2>Senior Citizens (60+)</h2>

    <table class="senior-table">
        <thead>
            <tr>
                <th>LDR Number</th>
                <th>Name</th>
                <th>Age</th>
                <th>Barangay</th>
                <th>Contact</th>
            </tr>
        </thead>

        <tbody>
            {{-- dito lalabas data --}}
        </tbody>
    </table>

</div>

@endsection