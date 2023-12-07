@extends('layouts.admin.index')
@section('title', 'Add new category')

@section('content')
    <x-breadcrumb parentName="Categories" parentLink="dashboard.category.index" childrenName="Add new category" />
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <x-alert />
                <x-header-table tableName="Add new category" link="dashboard.category.index" linkName="All categories" />
                <!-- Account -->
                <div class="card-body">
                    <form id="formAccountSettings" action="{{ route('dashboard.category.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">Category Name : <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('name') is-invalid @enderror " type="text"
                                    oninput="createSlug('name','slug')" id="name" name="name"
                                    value="{{ old('name') }}" placeholder="Category Name" autofocus />
                                @error('name')
                                    <p class="text-danger my-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="slug" class="form-label">URL: <span class="text-danger">*</span></label>
                                <input class="form-control @error('slug') is-invalid @enderror" type="text"
                                    id="slug" name="slug" value="{{ old('slug') }}" placeholder="URL" />
                                @error('slug')
                                    <p class="text-danger my-1">{{ $message }}</p>
                                @enderror
                            </div>


                            <div class=" mb-3 col-md-12">
                                <label for="description" class="form-label">Description:</label>

                                <textarea class="form-control @error('description') is-invalid @enderror " id="description" rows="5"
                                    name="description" placeholder="About 255 characters">{{ old('description') }}</textarea>
                                @error('description')
                                    <p class="text-danger my-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary me-2">Add new category</button>
                            <button type="reset" class="btn btn-outline-secondary">Reset</button>
                        </div>
                    </form>
                </div>
                <!-- /Account -->
            </div>
        </div>
    </div>
@endsection
