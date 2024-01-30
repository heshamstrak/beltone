@extends('admin.index')

@section('content')

    <div>
        <h2>services</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.services.index') }}">services</a></li>
        <li class="breadcrumb-item">Edit</li>
    </ul>

    <div class="card">
        <div class="card-body">
            <div class="row">

                <div class="col-md-12">
        
                    <div class="tile shadow">
        
                        <form method="post" action="{{ route('admin.services.update', $service->id) }}"  enctype="multipart/form-data">
                            @csrf
                            @method('put')
        
                            @include('admin.partials._errors')
                
                            {{-- Title --}}
                            <div class="form-group">
                                <label>Title <span class="text-danger">*</span></label>
                                <input type="text" name="title" autofocus class="form-control" value="{{ old('title', $service->title) }}" required>
                            </div>
                            
                
                            {{-- Link --}}
                            <div class="form-group">
                                <label>Link</label>
                                <input type="text" name="link" autofocus class="form-control" value="{{ old('link', $service->link  ) }}" required>
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
