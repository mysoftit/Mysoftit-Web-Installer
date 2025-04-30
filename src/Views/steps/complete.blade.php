@extends('installer::layout')

@section('content')
    <div class="text-center py-4">
        <h4 class="mb-3">Installation Complete!</h4>

        <div class="alert alert-success">
            <i class="bi bi-check-circle-fill"></i> Your application has been successfully installed.
        </div>

        <div class="card mb-4">
            <div class="card-header">
                Admin Credentials
            </div>
            <div class="card-body text-start">
                <p><strong>Email:</strong> {{ $adminCredentials['email'] }}</p>
                <p><strong>Password:</strong> The password you entered during installation</p>
            </div>
        </div>

        <div class="alert alert-warning">
            For security reasons, please delete the <code>install</code> directory.
        </div>

        <a href="{{ $loginUrl }}" class="btn btn-primary">Go to Login Page</a>
    </div>
@endsection

@php
    $progress = 100;
@endphp