<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
      <a class="navbar-brand" href="{{route('blog.index')}}">Laravel guide</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
              <li class="nav-item active">
                  <a class="nav-link" href="{{route('blog.index')}}">Blog </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="{{route('other.about')}}">About</a>
              </li>
              @if(!Auth::check())
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
              </li>
              <li class="nav-item">
                  @if (Route::has('register'))
                      <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                  @endif
              </li>
              @else
              <li class="nav-item"><a class="nav-link" href="{{route('blog.index')}}">posts</a></li>
              {{--'admin.index'--}}
              <li >
                  <a class="nav-link" href="{{ route('logout') }}"
                     onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                      {{ __('Logout') }}
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
              </li>
              @endif
          </ul>

      </div>
  </div>
</nav>