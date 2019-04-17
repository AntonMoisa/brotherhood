<header class="page-header">
  <div class="page-header__logo logo">
    <a class="logo__link" href="index.html" aria-label="Ссылка на главную страницу">
    <svg class="logo__img" role="img" width="84px" height="84px">
      <use xlink:href="{{ asset('img/svg/sprite.svg#logo') }}"></use>
    </svg>
    <span class="logo__text">Братство</span>
  </a>
  </div>

  <div class="page-header__user user">
    <div class="user__img">
      <img src="{{ asset('img/svg/login.svg') }}" alt="Изображение пользователя">
    </div>
    <div class="user__info">
      <p class="user__name">Имя Пользователя</p>
      <p class="user__role">администратор</p>
    </div>
    <div class="user__logout logout">
      <a class="logout__link" href="{{ route('logout') }}">
        <svg class="logout__img" role="img" width="40px" height="40px">
          <use xlink:href="{{ asset('img/svg/sprite.svg#logout') }}"></use>
        </svg>
        <span class="logout__text">Выход</span>
      </a>
    </div>
  </div>
</header>

@auth
  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
    <a class="dropdown-item" href="{{ route('logout') }}"
       onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
      {{ __('Logout') }}
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      @csrf
    </form>
  </div>
@endauth