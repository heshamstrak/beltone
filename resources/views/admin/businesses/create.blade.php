@extends('admin.index')

@section('content')

    <div>
        <h2>businesses</h2>
    </div>
    

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
        {{-- <li class="breadcrumb-item"><a href="{{ route('admin.businesses.index') }}">businesses</a></li> --}}
        <li class="breadcrumb-item">Create</li>
    </ul>

    <div class="card">
        <div class="card-body">
            <div class="row">

                <div class="col-md-12">
        
                    <div class="tile shadow">
        
                        <form method="post" action="{{ url('admin/businesses/'.$category->id) }}"  enctype="multipart/form-data">
                            @csrf
                            @method('post')
        
                            @include('admin.partials._errors')
        
                            {{-- Name --}}
                            <div class="form-group">
                                <label>Title <span class="text-danger">*</span></label>
                                <input type="text" name="title" autofocus class="form-control" value="{{ old('title') }}" required>
                            </div>
                            
                            {{--description--}}
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description" id="editor" style="height: 300px"></textarea>
                            </div>

                            {{--image--}}
                            <div class="form-group">
                                <label class="text-capitalize">Image</label>
                                <input type="file" name="image" id="input-file-now" class="dropify" data-height="585"/>
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
        ClassicEditor.create(document.querySelector('#editor'), {
            ckfinder: {
                uploadUrl: "{{route('admin.presses.upload.image')}}"
            },
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(editor => {
            console.log(editor);
        })
        .catch(error => {
            console.error(error);
        });
    </script>
@endpush
