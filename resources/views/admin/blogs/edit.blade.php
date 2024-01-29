@extends('admin.index')

@section('content')

    <div>
        <h2>blogs</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.blogs.index') }}">blogs</a></li>
        <li class="breadcrumb-item">Edit</li>
    </ul>

    <div class="card">
        <div class="card-body">
            <div class="row">

                <div class="col-md-12">
        
                    <div class="tile shadow">
        
                        <form method="post" action="{{ route('admin.blogs.update', $blog->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('put')
        
                            @include('admin.partials._errors')
        
                          
                            {{--Title--}}
                            <div class="form-group">
                                <label>Title <span class="text-danger">*</span></label>
                                <input type="text" name="title" autofocus class="form-control" value="{{ old('title', $blog->title) }}" required>
                            </div>
        
                            {{--description--}}
                            <div class="form-group">
                                <label>Description <span class="text-danger">*</span></label>
                                <textarea name="description" class="form-control" cols="30" rows="10">{{ old('description', $blog->description) }}</textarea>
                            </div>
        
        
                            {{--image--}}
                            <div class="form-group">
                                <label class="text-capitalize">Poster</label>
                                <input type="file" name="poster" id="input-file-now" class="dropify" @if(isset($blog)) data-default-file="{{$blog->poster_path}}" data-show-remove="false" @endif data-height="585"/>
                            </div>
        
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> Update</button>
                            </div>
        
                        </form><!-- end of form -->
        
                    </div><!-- end of tile -->
        
                </div><!-- end of col -->
        
            </div><!-- end of row -->
        
        </div>
    </div>


@endsection

@push('js')
    <script>
        $(document).ready(function(){
            $('.dropify').dropify();
        });
    </script>
@endpush
