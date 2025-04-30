@extends('installer::layout')

@section('content')
    <h4 class="mb-3">Database Import</h4>

    <div class="alert alert-info">
        The installer will now import the database schema and initial data.
    </div>

    <form method="POST" action="{{ route('installer.process-import') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">SQL File (optional)</label>
            <input type="file" class="form-control" name="sql_file" accept=".sql">
            <div class="form-text">Leave empty to use default database structure</div>
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-primary">Import Database</button>
        </div>
    </form>
@endsection

@php
    $progress = 60;
@endphp

@section('scripts')
    <script>
        document.querySelector('form').addEventListener('submit', function(e) {
            e.preventDefault();

            const button = this.querySelector('button[type="submit"]');
            button.disabled = true;
            button.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Importing...';

            this.submit();
        });
    </script>
@endsection