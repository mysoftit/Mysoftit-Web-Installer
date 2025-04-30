<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Web Installer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('vendor/installer/css/installer.css') }}" rel="stylesheet">
</head>
<body>
<div class="container installer-container">
    <div class="card">
        <div class="card-header">
            <h3 class="text-center">Laravel Web Installer</h3>
            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: {{ $progress }}%"></div>
            </div>
        </div>
        <div class="card-body">
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </div>
        <div class="card-footer text-center">
            Laravel Web Installer &copy; {{ date('Y') }}
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('vendor/installer/js/installer.js') }}"></script>
@yield('scripts')
</body>
</html>