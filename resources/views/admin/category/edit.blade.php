@extends('layouts.admin.index')
@section('title', 'Update Category')
@section('content')
    <x-breadcrumb parentName="Categories" parentLink="dashboard.category.index" childrenName="Update Category" />
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <x-alert />
                <x-header-table tableName="Update Category" link="dashboard.category.index" linkName="All categories" />
                <div class="card-body">
                    <form id="formAccountSettings" action="{{ route('dashboard.category.update', $category->id) }}"
                        method="POST">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">Category Name: <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('name') is-invalid @enderror " type="text"
                                    oninput="createSlug('name','slug')" id="name" name="name"
                                    value="{{ $category->name ?? old('name') }}" placeholder="Category Name" autofocus />
                                @error('name')
                                    <p class="text-danger my-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="slug" class="form-label">URL: <span class="text-danger">*</span></label>
                                <input class="form-control @error('slug') is-invalid @enderror" type="text"
                                    id="slug" name="slug" value="{{ $category->slug ?? old('slug') }}"
                                    placeholder="URL" />
                                @error('slug')
                                    <p class="text-danger my-1">{{ $message }}</p>
                                @enderror
                            </div>



                            <div class=" mb-3 col-md-12">
                                <label for="description" class="form-label">Description:</label>

                                <textarea class="form-control @error('description') is-invalid @enderror " id="description" rows="5"
                                    name="description" placeholder="About 255 characters">{{ $category->description ?? old('description') }}</textarea>
                                @error('description')
                                    <p class="text-danger my-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary me-2">Update Category</button>
                            <button type="reset" class="btn btn-outline-secondary">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
