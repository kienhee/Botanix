@extends('layouts.admin.index')
@section('title', 'Update group')

@section('content')
    <x-breadcrumb parentName="Groups" parentLink="dashboard.group.index" childrenName="Update group" />
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <x-alert />
                <x-header-table tableName="Update group" link="dashboard.group.index" linkName="All groups" />
                <!-- Account -->
                <div class="card-body">
                    <form id="formAccountSettings" action="{{ route('dashboard.group.update', $group->id) }}"
                        method="POST">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label for="name" class="form-label">Group name: <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('name') is-invalid @enderror " type="text"
                                    id="name" name="name" value="{{ old('name') ?? $group->name }}"
                                    placeholder="VD: ADMIN, MANAGER,..." autofocus />
                                @error('name')
                                    <p class="text-danger my-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary me-2">Update group</button>
                            <button type="reset" class="btn btn-outline-secondary">Reset</button>
                        </div>
                    </form>
                </div>
                <!-- /Account -->
            </div>
        </div>
    </div>
@endsection
