@extends('pages.staff.staff_dashboard')

@section('title', 'Local Profile Form')
@section('page_title', 'Local Profile Form')
@section('page_subtitle', 'Fill up details for local profiling.')

@section('body_class', 'lpf-page')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/local_profile_form.css') }}?v={{ filemtime(public_path('css/local_profile_form.css')) }}">
@endpush

@section('content')

@if (session('success'))
  <div class="lpf-alert lpf-alert-success lpf-animate-in" role="alert">
    <b>{{ session('success') }}</b>
  </div>
@endif

@if ($errors->any())
  <div class="lpf-alert lpf-alert-error lpf-animate-in" role="alert">
    <b>Please fix the errors:</b>
    <ul class="lpf-error-list">
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

<div class="lpf-card lpf-animate-in" aria-label="Local Profile Form Card">
  <div class="lpf-card-head">
    <div class="lpf-head-text">
      <h2 class="lpf-title">Local Profile Form</h2>
      <p class="lpf-sub">Provide the basic details below.</p>
    </div>
    <span class="lpf-pill">Form</span>
  </div>

  <div class="lpf-card-body">
    <form class="lpf-form" method="POST" action="{{ route('staff.local_profile_form.store') }}">
      @csrf

      <div class="lpf-grid lpf-stagger">

        <div class="lpf-field">
          <label class="lpf-label" for="full_name">Full Name</label>
          <input id="full_name" class="lpf-input" type="text" name="full_name"
                 value="{{ old('full_name') }}" placeholder="Juan Dela Cruz" autocomplete="name">
        </div>

        <div class="lpf-field">
          <label class="lpf-label" for="contact_number">Contact Number</label>
          <input id="contact_number" class="lpf-input" type="text" name="contact_number"
                 value="{{ old('contact_number') }}" placeholder="09xxxxxxxxx" inputmode="tel" autocomplete="tel">
        </div>

        <div class="lpf-field">
          <label class="lpf-label" for="address">Address</label>
          <input id="address" class="lpf-input" type="text" name="address"
                 value="{{ old('address') }}" placeholder="Complete address" autocomplete="street-address">
        </div>

        <div class="lpf-field">
          <label class="lpf-label" for="dob">Date of Birth</label>
          <input id="dob" class="lpf-input" type="date" name="dob" value="{{ old('dob') }}" autocomplete="bday">
        </div>

        <div class="lpf-field">
          <label class="lpf-label" for="gender">Gender</label>
          <select id="gender" class="lpf-select" name="gender" autocomplete="sex">
            <option value="">-- Select --</option>
            <option value="Male"   {{ old('gender') === 'Male' ? 'selected' : '' }}>Male</option>
            <option value="Female" {{ old('gender') === 'Female' ? 'selected' : '' }}>Female</option>
            <option value="Other"  {{ old('gender') === 'Other' ? 'selected' : '' }}>Other</option>
          </select>
        </div>

        <div class="lpf-field">
          <label class="lpf-label" for="pwd_id_no">PWD ID No.</label>
          <input id="pwd_id_no" class="lpf-input" type="text" name="pwd_id_no"
                 value="{{ old('pwd_id_no') }}" placeholder="Optional" autocomplete="off">
        </div>

      </div>

      <div class="lpf-field lpf-field-full lpf-stagger">
        <label class="lpf-label" for="remarks">Notes / Remarks</label>
        <textarea id="remarks" class="lpf-textarea" name="remarks" rows="4"
                  placeholder="Optional notes...">{{ old('remarks') }}</textarea>
      </div>

      <div class="lpf-actions">
        <a href="{{ route('staff.dashboard') }}" class="lpf-btn lpf-btn-ghost">Cancel</a>
        <button type="submit" class="lpf-btn lpf-btn-primary">Save Form</button>
      </div>

    </form>
  </div>
</div>

@endsection