@extends('admin.index')
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-1">
      <h3 class="content-header-title">Bootstrap Cards</h3>
    </div>
    <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-12">
      <div class="breadcrumb-wrapper col-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a>
          </li>
          <li class="breadcrumb-item"><a href="#">Components</a>
          </li>
          <li class="breadcrumb-item active">Bootstrap Cards
          </li>
        </ol>
      </div>
    </div>
  </div>


  <div class="card">
    <div class="card-body">
      <form action="{{route('admin.settings.store')}}" method="post" enctype="multipart/form-data" class="number-tab-stepss wizard-circle" id="setting-form">
        @csrf
        @method('post')

        @include('admin.partials._errors')
        <h6>General Setting</h6>
        <fieldset>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="email">Eamil :</label>
                <input type="text" name="email" class="form-control" id="email" value="{{old('email', setting('email'))}}">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="phone">Phone :</label>
                <input type="text" name="phone" class="form-control" id="phone" value="{{old('phone', setting('phone') != null ? setting('phone') : '')}}">
              </div>
            </div>
          </div>
         
          <div class="form-group">
            <label for="address">Address :</label>
            <input type="text" name="address" class="form-control" id="address" value="{{old('address', setting('address') != null ? setting('address') : '')}}">
          </div>
          
          <div class="form-group">
            <label for="address">Map Link :</label>
            <input type="text" name="map_link" class="form-control" id="map_link" value="{{old('map_link', setting('map_link') != null ? setting('map_link') : '')}}">
          </div>
          
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="text-capitalize">Logo Header</label>
                <input type="file" name="logo_header" id="input-file-now" class="logo-header" data-show-remove="false" @if(setting('logo_header') != null) data-default-file="{{Storage::url('public/uploads/settings/'.setting('logo_header'))}}" data-show-remove="false" alue="{{ old('logo_header', setting('logo_header')) }}"@endif  data-height="250"/>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="text-capitalize">Logo Footer</label>
                <input type="file" name="logo_footer" id="input-file-now" class="logo-footer" data-show-remove="false" @if(setting('logo_footer') != null) data-default-file="{{Storage::url('public/uploads/settings/'.setting('logo_footer'))}}" data-show-remove="false" alue="{{ old('logo_footer', setting('footer')) }}"@endif  data-height="250"/>
              </div>
            </div>
          </div>

        </fieldset>
    
        <h6>Social Linsk</h6>
        <fieldset>

            @php $socials = ['facebook', 'twitter', 'linkedin', 'youtube', 'instagram']; @endphp
            @foreach($socials as $social)
              <div class="form-group">
                  <label for="{{$social}}" class="text-capitalize">{{$social}} :</label>
                  <input type="text" name="{{$social}}" class="form-control" id="{{$social}}" value="{{old($social, setting($social) != null ? setting($social) : '')}}">
              </div>
            @endforeach
        </fieldset>
    
        <h6>About Us</h6>
        <fieldset>
            {{-- Title --}}
            <div class="form-group">
                <label for="title">Title :</label>
                <input type="text" name="title" class="form-control" id="title" value="{{old('title', setting('title') != null ? setting('title') : '')}}">
            </div>

            {{-- Link Video --}}
            <div class="form-group">
                <label for="link_video">Link Video :</label>
                <input type="text" name="link_video" class="form-control" id="link_video" value="{{old('link_video', setting('link_video') != null ? setting('link_video') : '')}}">
            </div>

            {{--description--}}
            <div class="form-group">
              <label>Description</label>
              <textarea name="description" class="form-control" cols="30" rows="10">{{ old('description', setting('description') != null ? setting('description') : '') }}</textarea>
            </div>
        </fieldset>
    </form>
    </div>
  </div>

@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{asset('admin_assets')}}/css/plugins/forms/wizard.min.css">

@endpush

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-steps/1.1.0/jquery.steps.min.js" integrity="sha512-bE0ncA3DKWmKaF3w5hQjCq7ErHFiPdH2IGjXRyXXZSOokbimtUuufhgeDPeQPs51AI4XsqDZUK7qvrPZ5xboZg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{asset('admin_assets')}}/js/scripts/forms/wizard-steps.min.js"></script>
<script>
  $(document).ready(function(){
      $('.logo-header, .logo-footer').dropify();
  });

  $(".number-tab-stepss").steps({
    headerTag: "h6",
    bodyTag: "fieldset",
    transitionEffect: "fade",
    titleTemplate: '<span class="step">#index#</span> #title#',
    labels: {
        finish: 'Submit'
    },
      onFinished: function (event, currentIndex) {
        var form = $(this);
        form.submit();
      }
  });
</script>
@endpush