@extends('admin.index')

@section('content')
@php $name = 'teams' @endphp
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
        
                        <form method="post" action="{{ route('admin.'.$name.'.update', $team->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('put')
        
                            @include('admin.partials._errors')
        
                            {{--Name--}}
                            <div class="form-group">
                                <label>Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" autofocus class="form-control" value="{{ old('name', $team->name) }}" required>
                            </div>

                            {{--Email--}}
                            <div class="form-group">
                                <label>Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" autofocus class="form-control" value="{{ old('email', $team->email) }}" required>
                            </div>

                            {{--job--}}
                            <div class="form-group">
                                <label>Job</label>
                                <input type="text" name="job" autofocus class="form-control" value="{{ old('job', $team->job) }}" required>
                            </div>

                            {{--Phone--}}
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="number" name="phone" autofocus class="form-control" value="{{ old('phone', $team->phone) }}">
                            </div>

                            {{--Facebook Link--}}
                            <div class="form-group">
                                <label>Facebook Link</label>
                                <input type="url" name="facebook_link" autofocus class="form-control" value="{{ old('facebook_link', $team->facebook_link) }}" placeholder="Facebook Link">
                            </div>
                        

                            {{--Twitter Link--}}
                            <div class="form-group">
                                <label>Twitter Link</label>
                                <input type="url" name="twitter_link" autofocus class="form-control" value="{{ old('twitter_link', $team->twitter_link) }}" placeholder="Twitter Link">
                            </div>
                        

                            {{--Linkedin Link--}}
                            <div class="form-group">
                                <label>Linkedin Link</label>
                                <input type="url" name="linkedin_link" autofocus class="form-control" value="{{ old('linkedin_link', $team->linkedin_link) }}" placeholder="Linkedin Link">
                            </div>
                        
                            {{--Image--}}
                            <div class="form-group">
                                <label class="text-capitalize">Image</label>
                                <input type="file" name="image" id="input-file-now" class="dropify" @if(isset($team)) data-default-file="{{$team->image_path}}" data-show-remove="false" @endif  data-height="585"/>
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
