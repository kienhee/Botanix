@extends('layouts.admin.index')
@section('title', 'Update project')
@section('content')
<x-breadcrumb parentName="Projects" parentLink="dashboard.project.index" childrenName="update project" />
<div class="row">
    <div class="col-md-12">
        <form method="POST" enctype="multipart/form-data" action="{{ route('dashboard.project.edit', $project->id) }}">
            @csrf
            @method('put')
            <div class="card mb-4">
                <x-alert />
                <x-header-table tableName="update project" link="dashboard.project.index" linkName="All projects" />
                <!-- Account -->
                <div class="card-body">

                    <div class="d-flex  align-items-center justify-content-center flex-column gap-4">
                        <img src="{{ $project->image ?? asset('images/upload.png') }}" alt="user-avatar"
                            class="d-block rounded-circle " style="object-fit:cover" height="120" width="120"
                            id="uploadedAvatar" />
                        <div class="button-wrapper">
                            <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                <span class="d-none d-sm-block">Upload Image</span>
                                <i class="bx bx-upload d-block d-sm-none"></i>
                                <input type="file" id="upload" class="account-file-input" hidden name="image"
                                    accept="image/png, image/jpeg" />
                            </label>
                            <p class="text-muted mb-0">JPG, PNG allowed.</p>
                        </div>
                        @error('image')
                        <p class="text-danger my-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
                <hr class="my-0" />
                <div class="card-body">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="name" class="form-label">Project Name: <span
                                    class="text-danger">*</span></label>
                            <input class="form-control  @error('name') is-invalid @enderror"
                                oninput="createSlug('name','slug')" value="{{ old('name') ?? $project->name }}"
                                type="text" id="name" name="name" />
                            @error('name')
                            <p class="text-danger my-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="slug" class="form-label">Slug: <span class="text-danger">*</span></label>
                            <input class="form-control  @error('slug') is-invalid @enderror"
                                value="{{ old('slug') ?? $project->slug }}" type="text" id="slug" name="slug" />
                            @error('slug')
                            <p class="text-danger my-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-12">
                            <label for="email" class="form-label ">E-mail: <span class="text-danger">*</span></label>
                            <input class="form-control  @error('email') is-invalid @enderror"
                                value="{{ old('email') ?? $project->email }}" name="email" type="text" />
                            @error('email')
                            <p class="text-danger my-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="category_id" class="form-label">Categories: <span
                                    class="text-danger">*</span></label>
                            <select class="form-select @error('category_id') is-invalid @enderror" name="category_id"
                                id="category_id">
                                <option>Please choose</option>
                                @foreach (getAllCategories() as $category)
                                <option {{ old('category_id')==$category->id || $project->category_id == $category->id ?
                                    'selected' : '' }}
                                    value="{{ $category->id }}">
                                    {{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <p class="text-danger my-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="verify" class="form-label">verify: </label>
                            <select class="form-select @error('verify') is-invalid @enderror" name="verify" id="verify">
                                <option {{ old('verify')=='0' || $project->verify == "0" ? 'selected' : '' }}
                                    value="0">
                                    Not verified</option>
                                <option {{ old('verify')=='1' || $project->verify == "1" ? 'selected' : '' }}
                                    value="1">
                                    Silver</option>
                                <option {{ old('verify')=='1' || $project->verify == "2" ? 'selected' : '' }}
                                    value="2">
                                    Gold</option>
                            </select>
                            @error('category_id')
                            <p class="text-danger my-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class=" mb-3 col-md-12">
                            <label for="description" class="form-label">Description:<span
                                    class="text-danger">*</span></label>
                            <textarea class="form-control @error('description') is-invalid @enderror " id="description"
                                rows="5" name="description">{{ old('description') ?? $project->description }}</textarea>
                            @error('description')
                            <p class="text-danger my-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class=" mb-3 col-md-12">
                            <label for="short_description" class="form-label">Short Description:<span
                                    class="text-danger">*</span></label>

                            <textarea class="form-control @error('short_description') is-invalid @enderror "
                                id="short_description" rows="3" name="short_description"
                                placeholder="About 255 characters">{{ old('short_description') ?? $project->short_description }}</textarea>
                            @error('short_description')
                            <p class="text-danger my-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="docs">Documentation
                                : </label>
                            <input class="form-control" type="text" value="{{ old('docs') ?? $project->docs }}"
                                id="docs" name="docs" />
                            @error('docs')
                            <p class="text-danger my-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="website">Website
                                : </label>
                            <input class="form-control" type="text" value="{{ old('website') ?? $project->website }}"
                                id="website" name="website" />
                            @error('website')
                            <p class="text-danger my-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="facebook">Facebook
                                : </label>
                            <input class="form-control" type="text" value="{{ old('facebook') ?? $project->facebook }}"
                                id="facebook" name="facebook" />
                            @error('facebook')
                            <p class="text-danger my-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="twitter">Twitter: </label>
                            <input class="form-control" type="text" value="{{ old('twitter') ?? $project->twitter }}"
                                id="twitter" name="twitter" />
                            @error('twitter')
                            <p class="text-danger my-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="telegram">Telegram: </label>
                            <input class="form-control" type="text" value="{{ old('telegram') ?? $project->telegram }}"
                                id="telegram" name="telegram" />
                            @error('telegram')
                            <p class="text-danger my-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="github">Github: </label>
                            <input class="form-control" type="text" value="{{ old('github') ?? $project->github }}"
                                id="github" name="github" />
                            @error('github')
                            <p class="text-danger my-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="discord">Discord: </label>
                            <input class="form-control" type="text" value="{{ old('discord') ?? $project->discord }}"
                                id="discord" name="discord" />
                            @error('discord')
                            <p class="text-danger my-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="medium">Medium: </label>
                            <input class="form-control" type="text" value="{{ old('medium') ?? $project->medium }}"
                                id="medium" name="medium" />
                            @error('medium')
                            <p class="text-danger my-1">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>
                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary me-2">Save</button>
                        <button type="reset" class="btn btn-outline-secondary">Reset</button>
                    </div>
                </div>
        </form>
        <!-- /Account -->
    </div>
</div>
</div>
<script>
    let imgInp = document.getElementById('upload');
        let preview = document.getElementById('uploadedAvatar');
        imgInp.onchange = evt => {
            const [file] = imgInp.files
            if (file) {
                preview.src = URL.createObjectURL(file)
            }
        }
</script>
@endsection