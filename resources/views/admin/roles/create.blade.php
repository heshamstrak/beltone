@extends('admin.index')

@section('content')

    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
          <h3 class="content-header-title mb-0">Roles</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}">Roles</a></li>
                <li class="breadcrumb-item">Create</li>
              </ol>
            </div>
          </div>
        </div>
    </div>



    <div class="content-body"><!-- Basic Tables start -->
        <div class="row">
            
            <div class="col-12">
                <div class="card">
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <form method="post" action="{{ route('admin.roles.store') }}">
                                @csrf
                                @method('post')
            
                                @include('admin.partials._errors')
            
                                {{--name--}}
                                <div class="form-group">
                                    <label>Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" autofocus class="form-control" value="{{ old('name') }}" required>
                                </div>
            
                                <h5>Permissions <span class="text-danger">*</span></h5>
            
                                @php
                                    $models = ['roles', 'admins', 'slides', 'categories', 'blogs', 'careers'];
                                @endphp
            
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Model</th>
                                        <th>Permissions</th>
                                    </tr>
                                    </thead>
            
                                    <tbody>
                                    @foreach ($models as $model)
                                        <tr>
                                            <td>{{$model}}</td>
                                            <td>
                                                <div class="animated-checkbox mx-2" style="display:inline-block;">
                                                    <label class="m-0">
                                                        <input type="checkbox" value="" name="" class="all-roles">
                                                        <span class="label-text">All</span>
                                                    </label>
                                                </div>
            
                                                @php
                                                    //create_roles, read_roles, update_roles, delete_roles
                                                        $permissionMaps = ['create', 'read', 'update', 'delete'];
                                                @endphp
            
                                                @foreach ($permissionMaps as $permissionMap)
                                                    <div class="animated-checkbox mx-2" style="display:inline-block;">
                                                        <label class="m-0">
                                                            <input type="checkbox" value="{{ $permissionMap . '_' . $model }}" name="permissions[]" class="role">
                                                            <span class="label-text"> {{$permissionMap}}</span>
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </td>
                                        </tr>
                                    @endforeach
            
                                    </tbody>
                                </table><!-- end of table -->
            
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>Create</button>
                                </div>
            
                            </form><!-- end of form -->
            
                        </div>
                
                    </div>
                </div>
            </div>
        </div>
        <!-- Basic Tables end -->
        
    </div>




@endsection


