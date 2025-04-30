@extends('installer::layout')

@section('content')
    <h4 class="mb-3">License Verification</h4>

    <form method="POST" action="{{ route('installer.verify-license') }}">
        @csrf

        <div class="mb-3">
            <label for="license_key" class="form-label">License Key</label>
            <input type="text" class="form-control" id="license_key" name="license_key" required>
            <div class="form-text">Enter your purchase license key</div>
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-primary">Verify License</button>
        </div>
    </form>
@endsection

@php
    $progress = 20;
@endphp