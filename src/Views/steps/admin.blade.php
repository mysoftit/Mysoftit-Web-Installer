@extends('installer::layout')

@section('content')
    <h4 class="mb-3">Admin Account Setup</h4>

    <form method="POST" action="{{ route('installer.save-admin') }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
            </div>
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-primary">Create Admin & Complete Installation</button>
        </div>
    </form>
@endsection

@php
    $progress = 80;
@endphp