<aside class="page-aside">
  <nav class="nav">
    <ul class="nav__list">
      <li class="nav__item active">
        <a class="nav__link" href="/frontend/dashboard">
        <svg class="nav__link-img" role="img" width="30px" height="30px">
          {{-- <use xlink:href="{{ asset('img/svg/sprite.svg#panel') }}"></use> --}}
        </svg>
        <span class="nav__link-text">Панель</span>
      </a>
      </li>
      <li class="nav__item">
        <a class="nav__link" href="/frontend/users">
        <svg class="nav__link-img" role="img" width="30px" height="30px">
          {{-- <use xlink:href="{{ asset('img/svg/sprite.svg#users') }}"></use> --}}
        </svg>
        <span class="nav__link-text">Пользователи</span>
      </a>
      </li>
      <li class="nav__item">
        <a class="nav__link" href="#">
        <svg class="nav__link-img" role="img" width="30px" height="30px">
          {{-- <use xlink:href="{{ asset('img/svg/sprite.svg#backup') }}"></use> --}}
        </svg>
        <span class="nav__link-text">Бэкап</span>
      </a>
      </li>
      <li class="nav__item">
        <a class="nav__link submenu" href="#">
        <svg class="nav__link-img" role="img" width="30px" height="30px">
          {{-- <use xlink:href="{{ asset('img/svg/sprite.svg#projects') }}"></use> --}}
        </svg>
        <span class="nav__link-text">Проекты</span>
      </a>

        <ul class="nav__sublist">
          <li class="nav__subitem">
            <a class="nav__sublink submenu" href="#">Строители</a>

            <ul class="nav__sublist">
              <li class="nav__subitem">
                <a class="nav__sublink" href="#">Модерация</a>
              </li>
              <li class="nav__subitem">
                <a class="nav__sublink" href="#">Материалы</a>
              </li>
            </ul>
          </li>
        </ul>
      </li>
      <li class="nav__item">
        <a class="nav__link" href="#">
        <svg class="nav__link-img" role="img" width="30px" height="30px">
          {{-- <use xlink:href="{{ asset('img/svg/sprite.svg#control') }}"></use> --}}
        </svg>
        <span class="nav__link-text">Управление интерфейсом</span>
      </a>
      </li>
      <li class="nav__item">
        <a class="nav__link" href="#">
        <svg class="nav__link-img" role="img" width="30px" height="30px">
          {{-- <use xlink:href="{{ asset('img/svg/sprite.svg#email-settings') }}"></use> --}}
        </svg>
        <span class="nav__link-text">Настройки почты</span>
      </a>
      </li>
    </ul>
  </nav>
</aside>