@extends('installer::layout')

@section('content')
    <h4 class="mb-3">Database Configuration</h4>

    <form method="POST" action="{{ route('installer.save-database') }}">
        @csrf

        <div class="mb-3">
            <label for="database_connection" class="form-label">Database Connection</label>
            <select class="form-select" id="database_connection" name="database_connection" required>
                <option value="mysql">MySQL</option>
                <option value="pgsql">PostgreSQL</option>
                <option value="sqlsrv">SQL Server</option>
                <option value="sqlite">SQLite</option>
            </select>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="database_hostname" class="form-label">Hostname</label>
                <input type="text" class="form-control" id="database_hostname" name="database_hostname" value="localhost" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="database_port" class="form-label">Port</label>
                <input type="text" class="form-control" id="database_port" name="database_port" value="3306" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="database_name" class="form-label">Database Name</label>
            <input type="text" class="form-control" id="database_name" name="database_name" required>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="database_username" class="form-label">Username</label>
                <input type="text" class="form-control" id="database_username" name="database_username" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="database_password" class="form-label">Password</label>
                <input type="password" class="form-control" id="database_password" name="database_password">
            </div>
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-primary">Save & Continue</button>
        </div>
    </form>
@endsection

@php
    $progress = 40;
@endphp