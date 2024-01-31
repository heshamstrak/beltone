@extends('admin.index')

@section('content')

    <div>
        <h2>investors</h2>
    </div>
    

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.investors.index') }}">investors</a></li>
        <li class="breadcrumb-item">Create</li>
    </ul>

    <div class="card">
        <div class="card-body">
            <div class="row">

                <div class="col-md-12">
        
                    <div class="tile shadow">
        
                        <form method="post" action="{{ route('admin.investors.store') }}"  enctype="multipart/form-data">
                            @csrf
                            @method('post')
        
                            @include('admin.partials._errors')
        
                            {{-- Name --}}
                            <div class="form-group">
                                <label>Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" autofocus class="form-control" value="{{ old('name') }}" required>
                            </div>

                            {{-- Parent --}}
                            <div class="form-group">
                                <label>Parent</label>
                                <select name="parent_id" id="" class="form-control">
                                    <option value="">.....</option>
                                    @foreach ($investors as $investor)
                                        <option value="{{$investor->id}}">{{$investor->name}}</option>
                                    @endforeach
                                </select>
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
