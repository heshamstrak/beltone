@extends('admin.index')

@section('content')

    <div>
        <h2>investors</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.investors.index') }}">investors</a></li>
        <li class="breadcrumb-item">Edit</li>
    </ul>

    <div class="card">
        <div class="card-body">
            <div class="row">

                <div class="col-md-12">
        
                    <div class="tile shadow">
        
                        <form method="post" action="{{ route('admin.investors.update', $investor->id) }}"  enctype="multipart/form-data">
                            @csrf
                            @method('put')
        
                            @include('admin.partials._errors')
                
                            {{-- Name --}}
                            <div class="form-group">
                                <label>Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" autofocus class="form-control" value="{{ old('name', $investor->name) }}" required>
                            </div>



                            {{-- Parent --}}
                            <div class="form-group">
                                <label>Parent</label>
                                <select name="parent_id" id="parent" class="form-control">
                                    <option value="">.....</option>
                                    @foreach ($investors as $row)
                                        <option value="{{$row->id}}"{{$row->id == $investor->parent_id ? 'selected' : ''}}>{{$row->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- URL --}}
                            <div class="form-group" id="url-investor" style="display: {{$investor->parent_id != null ? 'block' : 'none'}}">
                                <label>Url</label>
                                <input type="text"name="url" autofocus class="form-control" value="{{ old('url', $investor->url) }}" required>
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

        $(document).on('change', '#parent', function() {
            if (this.value != '')
                $('#url-investor').fadeIn();
            else
                $('#url-investor').fadeOut();
        })
    </script>
@endpush
