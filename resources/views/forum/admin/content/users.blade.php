@extends('forum.layouts.admin')
@section('content')
<section class="section users">
  <header class="section-header">
    <h2 class="section-header__title dashboard__title">Пользователи</h2>

    <div class="users__serch users-search">
      <form class="users-search__form">
        <div class="user-search__block">
          <input name="text" type="text">
          <select name="category">
            <option value="user">Поиск по пользователям</option>
            <option value="email">Поиск по email</option>
            <option value="country">Поиск по странам</option>
            <option value="phone">Поиск по телефону</option>
          </select> {{-- <button class="user-search__submit btn" type="submit" aria-label="Поиск">
            <svg class="table-controls__item-img" role="img" width="20px" height="20px">
              <use xlink:href="{{ asset('img/svg/sprite.svg#search') }}"></use>
            </svg>
          </button> --}}
        </div>
      </form>
    </div>
  </header>
  <div class="section-body users__body">
    <div class="users__table users-table">
      <table>
        <thead>
          <tr>
            <th>Имя</th>
            <th>Email</th>
            <th>Страна</th>
            <th>Телефон</th>
            <th>Роль</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Набоков Иннокентиевич</td>
            <td><a href="mailto:2tarek.matmeurx@mail.com">2tarek.matmeurx@mail.com</a></td>
            <td>2tarek.matmeurx</td>
            <td><a href="tel:+80291234567">80291234567</a></td>
            <td>Администратор</td>
            <td class="users-table__controls table-controls">
              <ul class="table-controls__list">
                <li class="table-controls__item">
                  <button type="button" title="Удалить пользователя">
                        <svg class="table-controls__item-img" role="img" width="20px" height="20px">
                          <use xlink:href="{{ asset('img/svg/sprite.svg#user-delete') }}"></use>
                        </svg>
                      </button>
                </li>
                <li class="table-controls__item">
                  <button type="button" title="Блокировать пользователя">
                        <svg class="table-controls__item-img" role="img" width="20px" height="20px">
                          <use xlink:href="{{ asset('img/svg/sprite.svg#user-block') }}"></use>
                        </svg>
                      </button>
                </li>
                <li class="table-controls__item">
                  <button type="button" title="Настройки пользователя">
                        <svg class="table-controls__item-img" role="img" width="20px" height="20px">
                          <use xlink:href="{{ asset('img/svg/sprite.svg#user-settings') }}"></use>
                        </svg>
                      </button>
                </li>
              </ul>
            </td>
          </tr>
          <tr>
            <td>Набоков Иннокентиевич</td>
            <td><a href="mailto:2tarek.matmeurx@mail.com">2tarek.matmeurx@mail.com</a></td>
            <td>2tarek.matmeurx</td>
            <td><a href="tel:+80291234567">80291234567</a></td>
            <td>Администратор</td>
            <td class="users-table__controls table-controls">
              <ul class="table-controls__list">
                <li class="table-controls__item">
                  <button type="button" title="Удалить пользователя">
                          <svg class="table-controls__item-img" role="img" width="20px" height="20px">
                            <use xlink:href="{{ asset('img/svg/sprite.svg#user-delete') }}"></use>
                          </svg>
                        </button>
                </li>
                <li class="table-controls__item">
                  <button type="button" title="Блокировать пользователя">
                          <svg class="table-controls__item-img" role="img" width="20px" height="20px">
                            <use xlink:href="{{ asset('img/svg/sprite.svg#user-block') }}"></use>
                          </svg>
                        </button>
                </li>
                <li class="table-controls__item">
                  <button type="button" title="Настройки пользователя">
                          <svg class="table-controls__item-img" role="img" width="20px" height="20px">
                            <use xlink:href="{{ asset('img/svg/sprite.svg#user-settings') }}"></use>
                          </svg>
                        </button>
                </li>
              </ul>
            </td>
          </tr>
          <tr>
            <td>Набоков Иннокентиевич</td>
            <td><a href="mailto:2tarek.matmeurx@mail.com">2tarek.matmeurx@mail.com</a></td>
            <td>2tarek.matmeurx</td>
            <td><a href="tel:+80291234567">80291234567</a></td>
            <td>Администратор</td>
            <td class="users-table__controls table-controls">
              <ul class="table-controls__list">
                <li class="table-controls__item">
                  <button type="button" title="Удалить пользователя">
                            <svg class="table-controls__item-img" role="img" width="20px" height="20px">
                              <use xlink:href="{{ asset('img/svg/sprite.svg#user-delete') }}"></use>
                            </svg>
                          </button>
                </li>
                <li class="table-controls__item">
                  <button type="button" title="Блокировать пользователя">
                            <svg class="table-controls__item-img" role="img" width="20px" height="20px">
                              <use xlink:href="{{ asset('img/svg/sprite.svg#user-block') }}"></use>
                            </svg>
                          </button>
                </li>
                <li class="table-controls__item">
                  <button type="button" title="Настройки пользователя">
                            <svg class="table-controls__item-img" role="img" width="20px" height="20px">
                              <use xlink:href="{{ asset('img/svg/sprite.svg#user-settings') }}"></use>
                            </svg>
                          </button>
                </li>
              </ul>
            </td>
          </tr>
          <tr>
            <td>Набоков Иннокентиевич</td>
            <td><a href="mailto:2tarek.matmeurx@mail.com">2tarek.matmeurx@mail.com</a></td>
            <td>2tarek.matmeurx</td>
            <td><a href="tel:+80291234567">80291234567</a></td>
            <td>Администратор</td>
            <td class="users-table__controls table-controls">
              <ul class="table-controls__list">
                <li class="table-controls__item">
                  <button type="button" title="Удалить пользователя">
                              <svg class="table-controls__item-img" role="img" width="20px" height="20px">
                                <use xlink:href="{{ asset('img/svg/sprite.svg#user-delete') }}"></use>
                              </svg>
                            </button>
                </li>
                <li class="table-controls__item">
                  <button type="button" title="Блокировать пользователя">
                              <svg class="table-controls__item-img" role="img" width="20px" height="20px">
                                <use xlink:href="{{ asset('img/svg/sprite.svg#user-block') }}"></use>
                              </svg>
                            </button>
                </li>
                <li class="table-controls__item">
                  <button type="button" title="Настройки пользователя">
                              <svg class="table-controls__item-img" role="img" width="20px" height="20px">
                                <use xlink:href="{{ asset('img/svg/sprite.svg#user-settings') }}"></use>
                              </svg>
                            </button>
                </li>
              </ul>
            </td>
          </tr>
          <tr>
            <td>Набоков Иннокентиевич</td>
            <td><a href="mailto:2tarek.matmeurx@mail.com">2tarek.matmeurx@mail.com</a></td>
            <td>2tarek.matmeurx</td>
            <td><a href="tel:+80291234567">80291234567</a></td>
            <td>Администратор</td>
            <td class="users-table__controls table-controls">
              <ul class="table-controls__list">
                <li class="table-controls__item">
                  <button type="button" title="Удалить пользователя">
                                <svg class="table-controls__item-img" role="img" width="20px" height="20px">
                                  <use xlink:href="{{ asset('img/svg/sprite.svg#user-delete') }}"></use>
                                </svg>
                              </button>
                </li>
                <li class="table-controls__item">
                  <button type="button" title="Блокировать пользователя">
                                <svg class="table-controls__item-img" role="img" width="20px" height="20px">
                                  <use xlink:href="{{ asset('img/svg/sprite.svg#user-block') }}"></use>
                                </svg>
                              </button>
                </li>
                <li class="table-controls__item">
                  <button type="button" title="Настройки пользователя">
                                <svg class="table-controls__item-img" role="img" width="20px" height="20px">
                                  <use xlink:href="{{ asset('img/svg/sprite.svg#user-settings') }}"></use>
                                </svg>
                              </button>
                </li>
              </ul>
            </td>
          </tr>
          <tr>
            <td>Набоков Иннокентиевич</td>
            <td><a href="mailto:2tarek.matmeurx@mail.com">2tarek.matmeurx@mail.com</a></td>
            <td>2tarek.matmeurx</td>
            <td><a href="tel:+80291234567">80291234567</a></td>
            <td>Администратор</td>
            <td class="users-table__controls table-controls">
              <ul class="table-controls__list">
                <li class="table-controls__item">
                  <button type="button" title="Удалить пользователя">
                    <svg class="table-controls__item-img" role="img" width="20px" height="20px">
                      <use xlink:href="{{ asset('img/svg/sprite.svg#user-delete') }}"></use>
                    </svg>
                  </button>
                </li>
                <li class="table-controls__item">
                  <button type="button" title="Блокировать пользователя">
                    <svg class="table-controls__item-img" role="img" width="20px" height="20px">
                      <use xlink:href="{{ asset('img/svg/sprite.svg#user-block') }}"></use>
                    </svg>
                  </button>
                </li>
                <li class="table-controls__item">
                  <button type="button" title="Настройки пользователя">
                    <svg class="table-controls__item-img" role="img" width="20px" height="20px">
                      <use xlink:href="{{ asset('img/svg/sprite.svg#user-settings') }}"></use>
                    </svg>
                  </button>
                </li>
              </ul>
            </td>
          </tr>
          <tr>
            <td>Набоков Иннокентиевич</td>
            <td><a href="mailto:2tarek.matmeurx@mail.com">2tarek.matmeurx@mail.com</a></td>
            <td>2tarek.matmeurx</td>
            <td><a href="tel:+80291234567">80291234567</a></td>
            <td>Администратор</td>
            <td class="users-table__controls table-controls">
              <ul class="table-controls__list">
                <li class="table-controls__item">
                  <button type="button" title="Удалить пользователя">
                    <svg class="table-controls__item-img" role="img" width="20px" height="20px">
                      <use xlink:href="{{ asset('img/svg/sprite.svg#user-delete') }}"></use>
                    </svg>
                  </button>
                </li>
                <li class="table-controls__item">
                  <button type="button" title="Блокировать пользователя">
                    <svg class="table-controls__item-img" role="img" width="20px" height="20px">
                      <use xlink:href="{{ asset('img/svg/sprite.svg#user-block') }}"></use>
                    </svg>
                  </button>
                </li>
                <li class="table-controls__item">
                  <button type="button" title="Настройки пользователя">
                    <svg class="table-controls__item-img" role="img" width="20px" height="20px">
                      <use xlink:href="{{ asset('img/svg/sprite.svg#user-settings') }}"></use>
                    </svg>
                  </button>
                </li>
              </ul>
            </td>
          </tr>
          <tr>
            <td>Набоков Иннокентиевич</td>
            <td><a href="mailto:2tarek.matmeurx@mail.com">2tarek.matmeurx@mail.com</a></td>
            <td>2tarek.matmeurx</td>
            <td><a href="tel:+80291234567">80291234567</a></td>
            <td>Администратор</td>
            <td class="users-table__controls table-controls">
              <ul class="table-controls__list">
                <li class="table-controls__item">
                  <button type="button" title="Удалить пользователя">
                    <svg class="table-controls__item-img" role="img" width="20px" height="20px">
                      <use xlink:href="{{ asset('img/svg/sprite.svg#user-delete') }}"></use>
                    </svg>
                  </button>
                </li>
                <li class="table-controls__item">
                  <button type="button" title="Блокировать пользователя">
                    <svg class="table-controls__item-img" role="img" width="20px" height="20px">
                      <use xlink:href="{{ asset('img/svg/sprite.svg#user-block') }}"></use>
                    </svg>
                  </button>
                </li>
                <li class="table-controls__item">
                  <button type="button" title="Настройки пользователя">
                    <svg class="table-controls__item-img" role="img" width="20px" height="20px">
                      <use xlink:href="{{ asset('img/svg/sprite.svg#user-settings') }}"></use>
                    </svg>
                  </button>
                </li>
              </ul>
            </td>
          </tr>
          <tr>
            <td>Набоков Иннокентиевич</td>
            <td><a href="mailto:2tarek.matmeurx@mail.com">2tarek.matmeurx@mail.com</a></td>
            <td>2tarek.matmeurx</td>
            <td><a href="tel:+80291234567">80291234567</a></td>
            <td>Администратор</td>
            <td class="users-table__controls table-controls">
              <ul class="table-controls__list">
                <li class="table-controls__item">
                  <button type="button" title="Удалить пользователя">
                    <svg class="table-controls__item-img" role="img" width="20px" height="20px">
                      <use xlink:href="{{ asset('img/svg/sprite.svg#user-delete') }}"></use>
                    </svg>
                  </button>
                </li>
                <li class="table-controls__item">
                  <button type="button" title="Блокировать пользователя">
                    <svg class="table-controls__item-img" role="img" width="20px" height="20px">
                      <use xlink:href="{{ asset('img/svg/sprite.svg#user-block') }}"></use>
                    </svg>
                  </button>
                </li>
                <li class="table-controls__item">
                  <button type="button" title="Настройки пользователя">
                    <svg class="table-controls__item-img" role="img" width="20px" height="20px">
                      <use xlink:href="{{ asset('img/svg/sprite.svg#user-settings') }}"></use>
                    </svg>
                  </button>
                </li>
              </ul>
            </td>
          </tr>
          <tr>
            <td>Набоков Иннокентиевич</td>
            <td><a href="mailto:2tarek.matmeurx@mail.com">2tarek.matmeurx@mail.com</a></td>
            <td>2tarek.matmeurx</td>
            <td><a href="tel:+80291234567">80291234567</a></td>
            <td>Администратор</td>
            <td class="users-table__controls table-controls">
              <ul class="table-controls__list">
                <li class="table-controls__item">
                  <button type="button" title="Удалить пользователя">
                    <svg class="table-controls__item-img" role="img" width="20px" height="20px">
                      <use xlink:href="{{ asset('img/svg/sprite.svg#user-delete') }}"></use>
                    </svg>
                  </button>
                </li>
                <li class="table-controls__item">
                  <button type="button" title="Блокировать пользователя">
                    <svg class="table-controls__item-img" role="img" width="20px" height="20px">
                      <use xlink:href="{{ asset('img/svg/sprite.svg#user-block') }}"></use>
                    </svg>
                  </button>
                </li>
                <li class="table-controls__item">
                  <button type="button" title="Настройки пользователя">
                    <svg class="table-controls__item-img" role="img" width="20px" height="20px">
                      <use xlink:href="{{ asset('img/svg/sprite.svg#user-settings') }}"></use>
                    </svg>
                  </button>
                </li>
              </ul>
            </td>
          </tr>
          <tr>
            <td>Набоков Иннокентиевич</td>
            <td><a href="mailto:2tarek.matmeurx@mail.com">2tarek.matmeurx@mail.com</a></td>
            <td>2tarek.matmeurx</td>
            <td><a href="tel:+80291234567">80291234567</a></td>
            <td>Администратор</td>
            <td class="users-table__controls table-controls">
              <ul class="table-controls__list">
                <li class="table-controls__item">
                  <button type="button" title="Удалить пользователя">
                    <svg class="table-controls__item-img" role="img" width="20px" height="20px">
                      <use xlink:href="{{ asset('img/svg/sprite.svg#user-delete') }}"></use>
                    </svg>
                  </button>
                </li>
                <li class="table-controls__item">
                  <button type="button" title="Блокировать пользователя">
                    <svg class="table-controls__item-img" role="img" width="20px" height="20px">
                      <use xlink:href="{{ asset('img/svg/sprite.svg#user-block') }}"></use>
                    </svg>
                  </button>
                </li>
                <li class="table-controls__item">
                  <button type="button" title="Настройки пользователя">
                    <svg class="table-controls__item-img" role="img" width="20px" height="20px">
                      <use xlink:href="{{ asset('img/svg/sprite.svg#user-settings') }}"></use>
                    </svg>
                  </button>
                </li>
              </ul>
            </td>
          </tr>
          <tr>
            <td>Набоков Иннокентиевич</td>
            <td><a href="mailto:2tarek.matmeurx@mail.com">2tarek.matmeurx@mail.com</a></td>
            <td>2tarek.matmeurx</td>
            <td><a href="tel:+80291234567">80291234567</a></td>
            <td>Администратор</td>
            <td class="users-table__controls table-controls">
              <ul class="table-controls__list">
                <li class="table-controls__item">
                  <button type="button" title="Удалить пользователя">
                    <svg class="table-controls__item-img" role="img" width="20px" height="20px">
                      <use xlink:href="{{ asset('img/svg/sprite.svg#user-delete') }}"></use>
                    </svg>
                  </button>
                </li>
                <li class="table-controls__item">
                  <button type="button" title="Блокировать пользователя">
                    <svg class="table-controls__item-img" role="img" width="20px" height="20px">
                      <use xlink:href="{{ asset('img/svg/sprite.svg#user-block') }}"></use>
                    </svg>
                  </button>
                </li>
                <li class="table-controls__item">
                  <button type="button" title="Настройки пользователя">
                    <svg class="table-controls__item-img" role="img" width="20px" height="20px">
                      <use xlink:href="{{ asset('img/svg/sprite.svg#user-settings') }}"></use>
                    </svg>
                  </button>
                </li>
              </ul>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="users__new">
      <button class="users__new-btn btn" type="button">
        <svg role="img" width="20px" height="20px">
          <use xlink:href="{{ asset('img/svg/sprite.svg#user-add') }}"></use>
        </svg>
        <span>Создать пользователя</span>
      </button>
    </div>
  </div>
</section>
@endsection