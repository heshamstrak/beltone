@extends('admin.index')

@section('content')
@php $name = 'presses'; @endphp
    <div>
        <h2>{{$name}}</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.'.$name.'.index') }}">{{$name}}</a></li>
        <li class="breadcrumb-item">Create</li>
    </ul>

    <div class="card">
        <div class="card-body">
            <div class="row">

                <div class="col-md-12">
        
                    <div class="tile shadow">
        
                        <form method="post" action="{{ route('admin.'.$name.'.store') }}" enctype="multipart/form-data">
                            @csrf
                            @method('post')
        
                            @include('admin.partials._errors')
        
                            <div class="row">
                                <div class="col-6" style="text-align: center">
                                    <label>Video</label>
                                    <input type="radio" name="type" autofocus class="form-control" id="video" required>
                                </div>
                                <div class="col-6" style="text-align: center">
                                    <label>Image</label>
                                    <input type="radio" name="type" autofocus class="form-control" id="image" required>
                                </div>
                            </div>
                            <br>
                            <hr>
                            <br>
                            {{--Title--}}
                            <div class="form-group">
                                <label>Title <span class="text-danger">*</span></label>
                                <input type="text" name="title" autofocus class="form-control" value="{{ old('title') }}" required>
                            </div>

                            {{--description--}}
                            <div class="form-group">
                                <label>Description <span class="text-danger">*</span></label>
                                <textarea name="description" class="form-control" cols="30" rows="10">{{ old('description') }}</textarea>
                            </div>

                            <div id="video-div" style="display: none">
                                {{--URL--}}
                                <div class="form-group">
                                    <label>Video Url</label>
                                    <input type="text" name="video_url" autofocus class="form-control" value="{{ old('video_url') }}" required>
                                </div>
                            </div>
             
                            <div id="image-div" style="display: none">
                                {{--Image--}}
                                <div class="form-group">
                                    <label class="text-capitalize">Image</label>
                                    <input type="file" name="image" id="input-file-now" class="dropify" data-show-remove="false"  data-height="585"/>
                                </div>
                            </div>
        
                 
                    
                  
        
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>Create</button>
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


        $('#video').on('click', function() {
            $('#image-div').hide()
            $('#video-div').show()
        });
        $('#image').on('click', function() {
            $('#video-div').hide()
            $('#image-div').show()
        });
    </script>
@endpush
