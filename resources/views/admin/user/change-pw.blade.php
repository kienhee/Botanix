@php
$moduleName = 'user';
@endphp

@extends('layouts.admin.index')
@section('title', 'User Information')
@section('content')
<x-breadcrumb parentName="User Information" parentLink="dashboard.user.account-setting"
    childrenName="Change password" />
<div class="row">
    <div class="col-md-12">
        <form method="POST" action="{{ route('dashboard.user.handle-change-password', Auth::user()->email) }}"
            enctype="multipart/form-data">
            <div class="card mb-4">
                @if (session('msgSuccess'))
                <div class=" mt-3 mx-3 alert alert-success alert-dismissible" role="alert">
                    {{ session('msgSuccess') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                @if (session('msgError'))
                <div class="mt-3 mx-3  alert alert-danger alert-dismissible" role="alert">
                    {{ session('msgError') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <h5 class="card-header">Change password</h5>
                <hr class="my-0" />
                <div class="card-body">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label for="currentPassword" class="form-label">Current Password: <span
                                    class="text-danger">*</span></label>
                            <input class="form-control" type="password" id="currentPassword" name="currentPassword" />
                            @error('currentPassword')
                            <p class="text-danger my-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-12">
                            <label for="password" class="form-label">Password: <span
                                    class="text-danger">*</span></label>
                            <input class="form-control" type="password" id="password" name="password" />
                            @error('password')
                            <p class="text-danger my-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-12">
                            <label for="password_confirmation" class="form-label">confirm Password: <span
                                    class="text-danger">*</span></label>
                            <input class="form-control" type="password" id="password_confirmation"
                                name="password_confirmation" />
                            @error('password_confirmation')
                            <p class="text-danger my-1">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>
                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary me-2">Save Changes</button>
                    </div>
                </div>
        </form>
    </div>
</div>
</div>

@endsection
