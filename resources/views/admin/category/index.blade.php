@extends('layouts.admin.index')
@section('title', 'Categories')
@section('content')
    <x-breadcrumb parentName="Categories" parentLink="dashboard.category.index" childrenName="All categories" />

    <div class="nav-align-top mb-4 mt-4">

        <ul class="nav nav-pills mb-3" role="tablist">
            <li class="nav-item">
                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                    data-bs-target="#navs-top-home" aria-controls="navs-top-home" aria-selected="true">
                    Categories Table
                </button>
            </li>
            <li class="nav-item">
                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                    data-bs-target="#navs-top-profile" aria-controls="navs-top-profile" aria-selected="false">
                    Categories Tree
                </button>
            </li>

        </ul>
        <div class="tab-content p-0">
            <div class="tab-pane fade active show" id="navs-top-home" role="tabpanel">
                <x-alert />
                <x-header-table tableName="Categories" link="dashboard.category.add" linkName="Add new category" />
                <form method="GET" class="mx-3 mb-4 mt-4">
                    <div class="row ">
                        <div class="col-md-6 col-lg-3 mb-2">
                            <div class="input-group input-group-merge">
                                <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
                                <input type="search" class="form-control" placeholder="Search category name"
                                    name="keywords" value="{{ Request()->keywords }}">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3 mb-2">
                            <select class="form-select" name="status">
                                <option value="">Status</option>
                                <option value="active" {{ Request()->status == 'active' ? 'selected' : '' }}>Active
                                </option>
                                <option value="inactive" {{ Request()->status == 'inactive' ? 'selected' : '' }}>Hidden
                                </option>
                            </select>
                        </div>
                        <div class="col-md-6 col-lg-3 mb-2">
                            <select class="form-select" name="sort">
                                <option value="">Filter</option>
                                <option value="desc" {{ Request()->sort == 'desc' ? 'selected' : '' }}>Latest
                                </option>
                                <option value="asc" {{ Request()->sort == 'asc' ? 'selected' : '' }}>oldest</option>
                            </select>
                        </div>
                        <div class="col-md-6 col-lg-3 mb-2 text-md-end">
                            <a href="{{ route('dashboard.category.index') }}" class="btn btn-outline-secondary me-2">Reset
                            </a>
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>

                    </div>
                </form>

                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="px-1 text-center" style="width: 50px">#ID</th>
                                <th>Name</th>
                                <th>Statu</th>
                                <th>Created At</th>
                                <th>Setting</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @if ($categories->count() > 0)

                                @foreach ($categories as $item)
                                    <tr>
                                        <td> <a href="{{ route('dashboard.category.edit', $item->id) }}"
                                                title="Click Read more"
                                                style="color:inherit"><strong>#{{ $item->id }}</strong>
                                            </a>
                                        </td>
                                        <td><a href="{{ route('dashboard.category.edit', $item->id) }}"
                                                title="Click Read more"
                                                style="color: inherit"><strong>{{ $item->name }}</strong>
                                            </a></td>


                                        <td><span
                                                class="badge  me-1 {{ $item->deleted_at == null ? 'bg-label-success ' : ' bg-label-primary' }}">{{ $item->deleted_at == null ? 'Active' : 'Hidden' }}</span>
                                        </td>

                                        <td>
                                            <p class="m-0">{{ $item->created_at->format('d/m/Y') }}</p>
                                            <small>{{ $item->created_at->format('h:i A') }}</small>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item"
                                                        href="{{ route('dashboard.category.edit', $item->id) }}"><i
                                                            class="bx bx-edit-alt me-1"></i>
                                                        Read More</a>

                                                    @if ($item->trashed() == 1)
                                                        <form class="dropdown-item"
                                                            action="{{ route('dashboard.category.restore', $item->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('delete')
                                                            <button class="btn p-0  w-100 text-start" type="submit">
                                                                <i class='bx bx-revision'></i>
                                                                Active Category
                                                            </button>
                                                        </form>
                                                    @endif
                                                    <form class="dropdown-item"
                                                        action="{{ $item->trashed() ? route('dashboard.category.force-delete', $item->id) : route('dashboard.category.soft-delete', $item->id) }}"
                                                        method="POST"
                                                        @if ($item->trashed()) onsubmit="return confirm('Are you sure you want to delete it permanently??')" @endif>
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn p-0  w-100 text-start" type="submit">
                                                            <i
                                                                class="bx {{ $item->trashed() ? 'bx-trash' : 'bx bxs-hand' }}  me-1"></i>
                                                            {{ $item->trashed() ? 'Permanently deleted' : 'Hidden Category' }}
                                                        </button>
                                                    </form>

                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="8" class="text-center">Empty!</td>
                                </tr>

                            @endif


                        </tbody>
                    </table>
                </div>
                <div class="mx-3 mt-3">
                    {{ $categories->withQueryString()->links() }}
                </div>
            </div>
            <div class="tab-pane fade" id="navs-top-profile" role="tabpanel">
                <x-alert />
                <x-header-table tableName="Categories" link="dashboard.category.add" linkName="Add new category" />
                <ul class="wtree">{{ menuTreeCategory(getAllCategories()) }}</ul>
            </div>
        </div>
    </div>
@endsection
