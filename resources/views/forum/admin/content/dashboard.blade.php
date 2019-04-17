@extends('forum.layouts.admin')
@section('content')
<section class="section dashboard">
  <header class="section-header">
    <h2 class="section-header__title dashboard__title visually-hidden">Панель с общей статистикой</h2>
  </header>
  <div class="section-body dashboard__body">
    <ul class="dashboard__list">
      <li class="dashboard__item dashboard-item dashboard-item--comments">
        <a class="dashboard-item__link" href="#">
          <span class="dashboard-item__count">15</span>
          <h3 class="dashboard-item__title">Количество <br> комментариев</h3>
        </a>
      </li>
      <li class="dashboard__item dashboard-item dashboard-item--users">
        <a class="dashboard-item__link" href="#">
          <span class="dashboard-item__count">70</span>
          <h3 class="dashboard-item__title">Количество <br> пользователей</h3>
        </a>
      </li>
      <li class="dashboard__item dashboard-item dashboard-item--unmoderated">
        <a class="dashboard-item__link" href="#">
          <span class="dashboard-item__count">25</span>
          <h3 class="dashboard-item__title">Неотмодерированные <br> комментарии</h3>
        </a>
      </li>
    </ul>
  </div>
</section>
@endsection