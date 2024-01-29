@extends('admin.index')

@section('content')
@php $name = 'presses' @endphp
    <div>
        <h2>{{$name}}</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.'.$name.'.index') }}">{{$name}}</a></li>
        <li class="breadcrumb-item">Edit</li>
    </ul>

    <div class="card">
        <div class="card-body">
            <div class="row">

                <div class="col-md-12">
        
                    <div class="tile shadow">
        
                        <form method="post" action="{{ route('admin.'.$name.'.update', $press->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('put')
        
                            @include('admin.partials._errors')
        
                          
                            {{--Title--}}
                            <div class="form-group">
                                <label>Title <span class="text-danger">*</span></label>
                                <input type="text" name="title" autofocus class="form-control" value="{{ old('title', $press->title) }}" required>
                            </div>
        
                            {{--description--}}
                            <div class="form-group">
                                <label>Description <span class="text-danger">*</span></label>
                                <textarea name="description" class="form-control" cols="30" rows="10">{{ old('description', $press->description) }}</textarea>
                            </div>
        
                            {{--URL--}}
                            <div class="form-group">
                                <label>Video Url</label>
                                <input type="text" name="video_url" autofocus class="form-control" value="{{ old('video_url', $press->video_url) }}" required>
                            </div>
        
                            {{--image--}}
                            <div class="form-group">
                                <label class="text-capitalize">Image</label>
                                <input type="file" name="image" id="input-file-now" class="dropify" @if(isset($press)) data-default-file="{{$press->image_path}}" data-show-remove="false" @endif data-height="585"/>
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
