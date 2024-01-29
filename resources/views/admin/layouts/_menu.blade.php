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
          @if(auth()->user()->hasPermission('read_blogs'))
            <li class=" nav-item"><a href="{{route('admin.blogs.index')}}"><i class="ft-home"></i><span class="menu-title" data-i18n="">Blogs</span></a></li>
          @endif
          @if(auth()->user()->hasPermission('read_categories'))
            <li class=" nav-item"><a href="{{route('admin.categories.index')}}"><i class="ft-home"></i><span class="menu-title" data-i18n="">Categories</span></a></li>
          @endif
          @if(auth()->user()->hasPermission('read_presses'))
            <li class=" nav-item"><a href="{{route('admin.presses.index')}}"><i class="ft-home"></i><span class="menu-title" data-i18n="">Presses</span></a></li>
          @endif
          @if(auth()->user()->hasPermission('read_careers'))
            <li class=" nav-item"><a href="{{route('admin.careers.index')}}"><i class="ft-home"></i><span class="menu-title" data-i18n="">Careers</span></a></li>
          @endif
      </ul>
    </div>
</div>
