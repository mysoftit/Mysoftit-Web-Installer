@extends('installer::layout')

@section('content')
    <h4 class="mb-3">Server Requirements</h4>

    <div class="table-responsive mb-4">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Requirement</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            @foreach($requirements as $requirement => $status)
                <tr>
                    <td>{{ $requirement }}</td>
                    <td>
                        @if($status)
                            <span class="badge bg-success">OK</span>
                        @else
                            <span class="badge bg-danger">Failed</span>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <h4 class="mb-3">Permissions</h4>

    <div class="table-responsive mb-4">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Folder/File</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            @foreach($permissions as $folder => $status)
                <tr>
                    <td>{{ $folder }}</td>
                    <td>
                        @if($status)
                            <span class="badge bg-success">Writable</span>
                        @else
                            <span class="badge bg-danger">Not Writable</span>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    @if($allRequirementsMet)
        <div class="text-end">
            <a href="{{ route('installer.license') }}" class="btn btn-primary">Continue</a>
        </div>
    @else
        <div class="alert alert-danger">
            Please fix all requirements before proceeding.
        </div>
    @endif
@endsection

@php
    $progress = 10;
    $allRequirementsMet = !in_array(false, $requirements) && !in_array(false, $permissions);
@endphp