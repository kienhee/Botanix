@extends('layouts.client.index')
@section('title', 'Submit')
@section('content')

    <section class="submit ">
        <h2 class="submit__title">Submit Your Project</h2>
        <p class="submit__description">Base Universe's objective is to assist the Base community in navigating and
            understanding the swiftly
            evolving ecosystem
            with enhanced ease and clarity.</p>
            <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
        <form action="{{ route('client.post-submit') }}" method="POST" class="submit__form" enctype="multipart/form-data">
            @csrf
            <div class="image-selector-container">
                <div class="image-selector ">
                    <input type="file" id="file-input" name="image" accept="image/*" />
                    <label for="file-input" class="image-preview  @error('image') image-preview-error @enderror">
                        <span>Choose Image</span>
                    </label>
                    <img id="preview-image" alt="Preview Image" />
                </div>
                @error('image')
                    <span class="form__require">{{ $message }}</span>
                @enderror
            </div>
            <div class="form__group">
                <label for="name">Project Name <span class="form__require">*</span></label>
                <input type="text" value="{{ old('name') }}" name="name"
                    class="form__input @error('name') form__error @enderror ">
                @error('name')
                    <span class="form__require">{{ $message }}</span>
                @enderror
            </div>
            <div class="form__group">
                <label for="category_id">Category <span class="form__require">*</span></label>
                <select name="category_id" class="form__input @error('category_id') form__error @enderror">
                    <option value="">Please choose</option>
                    @foreach (getAllCategories() as $category)
                        <option {{ old('category_id') == $category->id ? 'selected' : '' }} value="{{ $category->id }}">
                            {{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <span class="form__require">{{ $message }}</span>
                @enderror
            </div>
            <div class="form__group">
                <label for="email">Email <span class="form__require">*</span></label>
                <input type="text" value="{{ old('email') }}" name="email"
                    class="form__input @error('email') form__error @enderror">
                @error('email')
                    <span class="form__require">{{ $message }}</span>
                @enderror
            </div>
            <div class="form__group">
                <label for="description">Description <span class="form__require">*</span></label>
                <textarea name="description" class="form__input @error('description') form__error @enderror" rows="10">{{ old('description') }}</textarea>
                @error('description')
                    <span class="form__require">{{ $message }}</span>
                @enderror
            </div>
            <div class="form__group">
                <label for="short_description">Short Description <span class="form__require">*</span></label>
                <textarea name="short_description" class="form__input @error('short_description') form__error @enderror" rows="5">{{ old('short_description') }}</textarea>
                @error('short_description')
                    <span class="form__require">{{ $message }}</span>
                @enderror
            </div>
            <div class="form__group">
                <label for="docs">Documentation </label>
                <input type="text" value="{{ old('docs') }}" name="docs"
                    class="form__input @error('docs') form__error @enderror">
                @error('docs')
                    <span class="form__require">{{ $message }}</span>
                @enderror
            </div>
            <div class="form__group">
                <label for="website">Website </label>
                <input type="text" value="{{ old('website') }}" name="website"
                    class="form__input @error('website') form__error @enderror">
                @error('website')
                    <span class="form__require">{{ $message }}</span>
                @enderror
            </div>
            <div class="form__group">
                <label for="facebook">Facebook </label>
                <input type="text" value="{{ old('facebook') }}" name="facebook"
                    class="form__input @error('facebook') form__error @enderror">
                @error('facebook')
                    <span class="form__require">{{ $message }}</span>
                @enderror
            </div>
            <div class="form__group">
                <label for="twitter">Twitter </label>
                <input type="text" value="{{ old('twitter') }}" name="twitter"
                    class="form__input @error('twitter') form__error @enderror">
                @error('twitter')
                    <span class="form__require">{{ $message }}</span>
                @enderror
            </div>
            <div class="form__group">
                <label for="telegram">Telegram </label>
                <input type="text" value="{{ old('telegram') }}" name="telegram"
                    class="form__input @error('telegram') form__error @enderror">
                @error('telegram')
                    <span class="form__require">{{ $message }}</span>
                @enderror
            </div>
            <div class="form__group ">
                <label for="github">Github </label>
                <input type="text" value="{{ old('github') }}" name="github"
                    class="form__input @error('github') form__error @enderror">
                @error('github')
                    <span class="form__require">{{ $message }}</span>
                @enderror
            </div>
            <div class="form__group">
                <label for="discord">Discord </label>
                <input type="text" value="{{ old('discord') }}" name="discord"
                    class="form__input @error('discord') form__error @enderror">
                @error('discord')
                    <span class="form__require">{{ $message }}</span>
                @enderror
            </div>
            <div class="form__group">
                <label for="medium">Medium </label>
                <input type="text" value="{{ old('medium') }}" name="medium"
                    class="form__input @error('medium') form__error @enderror">
                @error('medium')
                    <span class="form__require">{{ $message }}</span>
                @enderror
            </div>
            <div class="submit__btn">
                <button type="reset" onclick=" scrollToTop()" class="btn btn-outline">Clear content</button>
                <button type="submit" class="btn btn-primary">Submit Project</button>
            </div>

        </form>
    </section>
    <script>
        function scrollToTop() {
            document.body.scrollTop = 0; // Cho trình duyệt Firefox
            document.documentElement.scrollTop = 0; // Cho các trình duyệt khác
        }
        document.getElementById('file-input').addEventListener('change', function(event) {
            const fileInput = event.target;
            const previewImage = document.getElementById('preview-image');
            const imagePreviewLabel = document.querySelector('.image-preview span');

            const file = fileInput.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewImage.style.display = 'block';
                    imagePreviewLabel.style.display = 'none';
                };

                reader.readAsDataURL(file);
            } else {
                previewImage.style.display = 'none';
                imagePreviewLabel.style.display = 'block';
            }
        });
    </script>
@endsection
