@extends('admin.index')

@section('content')

    <div>
        <h2>slides</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.slides.index') }}">slides</a></li>
        <li class="breadcrumb-item">Create</li>
    </ul>

    <div class="card">
        <div class="card-body">
            <div class="row">

                <div class="col-md-12">
        
                    <div class="tile shadow">
        
                        <form method="post" action="{{ route('admin.slides.store') }}" enctype="multipart/form-data">
                            @csrf
                            @method('post')
        
                            @include('admin.partials._errors')
        
                            {{--Title--}}
                            <div class="form-group">
                                <label>Title <span class="text-danger">*</span></label>
                                <input type="text" name="title" autofocus class="form-control" value="{{ old('title') }}" required>
                            </div>
       
                            {{--Link--}}
                            <div class="form-group">
                                <label>Link</label>
                                <input type="text" name="link" autofocus class="form-control" value="{{ old('link') }}">
                            </div>
        
                            {{--image--}}
                            <div class="form-group">
                                <label class="text-capitalize">Image</label>
                                <input type="file" name="image" id="input-file-now" class="dropify" data-show-remove="false"  data-height="585"/>
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
    </script>
@endpush
