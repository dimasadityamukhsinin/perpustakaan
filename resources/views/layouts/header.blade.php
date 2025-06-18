  <header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
        <b>Perpustakaan</b>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}" class="user-image" alt="User Image">
              <span class="hidden-xs">
                @if(Auth::user()->role === 'admin')
                    Admin
                @else
                    {{ Auth::user()->nama }}
                @endif
              </span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
                <p>
                    @if(Auth::user()->role === 'admin')
                        Admin
                    @else
                        {{ Auth::user()->nama }}
                    @endif
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                  <a href="{{ route('logout') }}" class="btn btn-default btn-flat">Sign out</a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>