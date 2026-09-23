@extends('backend.admin-master')
@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/bootstrap-tagsinput.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/summernote-bs4.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/dropzone.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/media-uploader.css')}}">
@endsection
@section('site-title')
    {{__('Edit Blog Post')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                <x-flash-msg/>
                <x-error-msg/>
            </div>
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrap d-flex justify-content-between">
                            <h4 class="header-title">{{__('Edit Blog Post')}}</h4>
                            <a href="{{route('admin.blog')}}" class="btn btn-primary">{{__('All Blog')}}</a>
                        </div>

                        <form action="{{route('admin.blog.update',$blog_post->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" id="old_category" value="{{ old('category', $blog_post->blog_categories_id) }}">
                            <input type="hidden" id="old_language" value="{{ old('lang', $blog_post->lang) }}">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <label for="language"><strong>{{ __('Language') }}</strong></label>
                                        <select name="lang" id="language" class="form-control">
                                            @foreach($all_languages as $lang)
                                                <option value="{{ $lang->slug }}"
                                                        {{ old('lang', $blog_post->lang) == $lang->slug ? 'selected' : '' }}>
                                                    {{ $lang->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="title">{{ __('Title') }}</label>
                                        <input type="text" class="form-control" id="title" name="title"
                                               value="{{ old('title', $blog_post->title) }}">
                                    </div>

                                    <div class="form-group">
                                        <label>{{ __('Content') }}</label>
                                        <textarea class="form-control d-none" name="blog_content">{{ old('blog_content', $blog_post->content) }}</textarea>
                                        <div class="summernote"
                                             data-content="{{ old('blog_content', iFrameFilterInSummernoteAndRender($blog_post->content)) }}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="meta_tags">{{ __('Meta Tags') }}</label>
                                        <input type="text" name="meta_tags" class="form-control"
                                               data-role="tagsinput" id="meta_tags"
                                               value="{{ old('meta_tags', $blog_post->meta_tags) }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="meta_description">{{ __('Meta Description') }}</label>
                                        <textarea name="meta_description" class="form-control" rows="5" id="meta_description">{{ old('meta_description', $blog_post->meta_description) }}</textarea>
                                    </div>

                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="slug">{{ __('Slug') }}</label>
                                        <input type="text" class="form-control" id="slug" name="slug"
                                               placeholder="{{ __('Slug') }}"
                                               value="{{ old('slug', $blog_post->slug) }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="excerpt">{{ __('Excerpt') }}</label>
                                        <textarea name="excerpt" id="excerpt" class="form-control max-height-150" cols="30" rows="10">{{ old('excerpt', $blog_post->excerpt)}}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="category">{{ __('Category') }}</label>
                                        <select name="category" class="form-control" id="category">
                                            <option value="">{{ __("Select Category") }}</option>
                                            @foreach($all_category as $category)
                                                <option value="{{ $category->id }}"
                                                        {{ old('category', $blog_post->blog_categories_id) == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="title">{{__('Tags')}}</label>
                                        <input type="text" class="form-control" name="tags" data-role="tagsinput"
                                               value="{{ old('tags', $blog_post->tags) }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="author">{{__('Author Name')}}</label>
                                        <input type="text" class="form-control" id="author" name="author"
                                               value="{{ old('author', $blog_post->author) }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="video_url">{{__('Video Url')}}</label>
                                        <input type="text" class="form-control" name="video_url"
                                               value="{{ old('video_url', $blog_post->video_url) }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="breaking_news"><strong>{{__('Is Breaking News')}}</strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="breaking_news"
                                                    {{ old('breaking_news', $blog_post->breaking_news) ? 'checked' : '' }}>
                                            <span class="slider onff"></span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label for="status">{{__('Status')}}</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="publish" {{ old('status', $blog_post->status) === 'publish' ? 'selected' : '' }}>
                                                {{ __('Publish') }}
                                            </option>
                                            <option value="draft" {{ old('status', $blog_post->status) === 'draft' ? 'selected' : '' }}>
                                                {{ __('Draft') }}
                                            </option>
                                        </select>
                                    </div>
                                    <x-media-upload :id="$blog_post->image" :name="'image'" :dimentions="'1920x1280'" :title="__('Image')"/>
                                    <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Post')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('backend.partials.media-upload.media-upload-markup')
@endsection
@section('script')
    <script src="{{asset('assets/backend/js/summernote-bs4.js')}}"></script>
    <script src="{{asset('assets/backend/js/bootstrap-tagsinput.js')}}"></script>
    <x-backend.auto-slug-js :url="route('admin.blog.slug.check')" :type="'update'"/>
    <script>
        $(document).ready(function () {



            $('.summernote').summernote({
                height: 400,   //set editable area's height
                codemirror: { // codemirror options
                    theme: 'monokai'
                },
                callbacks: {
                    onChange: function(contents, $editable) {
                        
                        let finalContenat =  iFrameFilterInSummernote(contents);

                        // console.log(finalContenat)
                        
                        $(this).prev('textarea').val(finalContenat);
                    }
                }
            });
            if($('.summernote').length > 0){
                $('.summernote').each(function(index,value){
                    $(this).summernote('code', $(this).data('content'));
                });
            }

            $(document).on('change', '#language', function(e){
                e.preventDefault();
                var selectedLang = $(this).val();

                $.ajax({
                    url: "{{ route('admin.blog.lang.cat') }}",
                    type: "POST",
                    data: {
                        _token : "{{ csrf_token() }}",
                        lang : selectedLang
                    },
                    success:function (data) {
                        $('#category').html('<option value="">Select Category</option>');
                        $.each(data, function(index, value){
                            $('#category').append('<option value="'+value.id+'">'+value.name+'</option>')
                        });

                        // select old category if exists
                        let oldCategory = $('#old_category').val();
                        if (oldCategory) {
                            $('#category').val(oldCategory);
                        }
                    }
                });
            });

            let oldLang = $('#old_language').val();
            if (oldLang) {
                $('#language').val(oldLang).trigger('change');
            }

        });
    </script>
    <script src="{{asset('assets/backend/js/dropzone.js')}}"></script>
    @include('backend.partials.media-upload.media-js')
@endsection
