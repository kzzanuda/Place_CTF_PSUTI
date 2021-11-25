<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-light bg-blue">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="/"><img src="{{asset('storage/logo-white.png')}}" alt="logo" class="logo"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-expanded="false" aria-controls="navbarSupportedContent"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item"><a class="text-light nav-link active" aria-current="page" href="{{ route('home') }}">Главная</a></li>
                <li class="nav-item"><a class="text-light nav-link" href="{{ route('tasks.list') }}">Задачи</a></li>
                <li class="nav-item"><a class="text-light nav-link" href="{{ route('scoreboard') }}">Результаты</a></li>
                <li class="nav-item"><a class="text-light nav-link" href="{{ route('masters') }}">Мастер-классы</a></li>
                @if(Auth::user() && Auth::user()->role == 'admin')
                <li class="nav-item"><a class="text-light nav-link" href="{{ route('admin.index') }}">Админка</a></li>
                @endif
            </ul>
            <div class="d-flex">
            @if( Auth::check() and Route::has('register') and (Auth::user()->role == "admin" or Auth::user()->role == "juri") )
              <a class="nav-link text-light" href="/register" type="button" name="button">Регистрация</a>
            @endif
            @if( !Auth::check() and (Route::has('login') or Route::has('register')) )
              <a class="btn btn-outline-light" href="/login" type="button">Вход</a>
            </div>
            @endif
            @if( Auth::check() )
              <div class="btn-group">
                <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  {{ Auth::user()->name }}
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                  <a class="dropdown-item text-dark" href="{{ route('user.profile', Auth::user()->getAuthIdentifier() ) }}">Профиль</a>
                  <div class="dropdown-divider"></div>
                  <form method="POST" action="{{ route('logout') }}">
                      @csrf
                      <a class="dropdown-item text-dark" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                          Выход
                      </a>
                  </form>
                </div>
              </div>
            @endif
        </div>
    </div>
</nav>
