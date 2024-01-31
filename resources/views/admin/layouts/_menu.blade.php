<div class="main-menu menu-fixed menu-light menu-accordion" data-scroll-to-active="true">
    <div class="main-menu-content">
      <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
        <li class=" navigation-header">
          <span>General</span><i class=" ft-minus" data-toggle="tooltip" data-placement="right"
          data-original-title="General"></i>
        </li>
          <li class=" nav-item"><a href="{{route('admin.home')}}"><i class="ft-home"></i><span class="menu-title" data-i18n="">Dashboard</span></a></li>
          @if(auth()->user()->hasPermission('read_admins'))
            <li class=" nav-item"><a href="{{route('admin.admins.index')}}"><i class="ft-home"></i><span class="menu-title" data-i18n="">Admins</span></a></li>
          @endif
          @if(auth()->user()->hasPermission('read_roles'))
          <li class=" nav-item"><a href="{{route('admin.roles.index')}}"><i class="ft-home"></i><span class="menu-title" data-i18n="">Roles</span></a></li>
          @endif
          @if(auth()->user()->hasPermission('read_users'))
            <li class=" nav-item"><a href="{{route('admin.users.index')}}"><i class="ft-home"></i><span class="menu-title" data-i18n="">Users</span></a></li>
          @endif
          @if(auth()->user()->hasPermission('read_slides'))
            <li class=" nav-item"><a href="{{route('admin.slides.index')}}"><i class="ft-home"></i><span class="menu-title" data-i18n="">Slides</span></a></li>
          @endif
          @if(auth()->user()->hasPermission('read_abouts'))
            <li class=" nav-item"><a href="{{route('admin.abouts.index')}}"><i class="ft-home"></i><span class="menu-title" data-i18n="">About Us</span></a></li>
          @endif
          @if(auth()->user()->hasPermission('read_blogs'))
            <li class=" nav-item"><a href="{{route('admin.blogs.index')}}"><i class="ft-home"></i><span class="menu-title" data-i18n="">Blogs</span></a></li>
          @endif
          @if(auth()->user()->hasPermission('read_presses'))
            <li class=" nav-item"><a href="{{route('admin.presses.index')}}"><i class="ft-home"></i><span class="menu-title" data-i18n="">Presses</span></a></li>
          @endif
          @if(auth()->user()->hasPermission('read_careers'))
            <li class=" nav-item"><a href="{{route('admin.careers.index')}}"><i class="ft-home"></i><span class="menu-title" data-i18n="">Careers</span></a></li>
          @endif
          @if(auth()->user()->hasPermission('read_teams'))
            <li class=" nav-item"><a href="{{route('admin.teams.index')}}"><i class="ft-home"></i><span class="menu-title" data-i18n="">Teams</span></a></li>
          @endif
          @if(auth()->user()->hasPermission('read_products'))
            <li class=" nav-item"><a href="{{route('admin.products.index')}}"><i class="ft-home"></i><span class="menu-title" data-i18n="">Products</span></a></li>
          @endif
          @if(auth()->user()->hasPermission('read_services'))
            <li class=" nav-item"><a href="{{route('admin.services.index')}}"><i class="ft-home"></i><span class="menu-title" data-i18n="">Services</span></a></li>
          @endif
          @if(auth()->user()->hasPermission('read_categories'))
            <li class=" nav-item"><a href="{{route('admin.categories.index')}}"><i class="ft-home"></i><span class="menu-title" data-i18n="">Categories</span></a></li>
          @endif
          @if(auth()->user()->hasPermission('read_pages'))
            <li class=" nav-item"><a href="{{route('admin.pages.index')}}"><i class="ft-home"></i><span class="menu-title" data-i18n="">Pages</span></a></li>
          @endif
          @if(auth()->user()->hasPermission('read_investors'))
            <li class=" nav-item"><a href="{{route('admin.investors.index')}}"><i class="ft-home"></i><span class="menu-title" data-i18n="">Investor</span></a></li>
          @endif
          @if(auth()->user()->hasPermission('read_businesses'))
           {{-- // <li class=" nav-item"><a href="{{route('admin.businesses.index')}}"><i class="ft-home"></i><span class="menu-title" data-i18n="">Businesses</span></a></li> --}}
        
            <li class="nav-item has-sub"><a href="#"><i class="ft-monitor"></i><span class="menu-title" data-i18n="Templates">Templates</span></a>
              <ul class="menu-content" style="">
                @foreach($categories as $category)
                  <li class="has-sub is-shown"><a class="menu-item" href="#" data-i18n="Vertical">{{$category->name}}</a>
                    <ul class="menu-content">
                      <li><a class="menu-item" href="{{url('admin/businesses/'.$category->id.'/create')}}" data-i18n="Modern Menu">Create</a></li>
                    </ul>
                  </li>
                @endforeach
              </ul>
            </li>
      
          @endif
      </ul>
    </div>
</div>
