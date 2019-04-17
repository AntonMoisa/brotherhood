@extends('frontend.layouts.inner')
  @include('frontend.modules.header') 
@section('content')
<main class="page-content builders container" id="app">
  <section class="builders__intro">
    <h1 class="page-title builders__intro-title">Строители</h1>
    <b class="page-subtitle builders__intro-subtitle">Нас уже более <span>500</span>
    </b>

    <button class="btn builders__join-btn">Присоединиться</button>
  </section>

  <section class="builders__content">
    <h2 class="visually-hidden">Основной контент на странице</h2>

    <section class="builders__quotes quotes active">
      <h3 class="quotes__title">Братство - это...</h3>
      
      <endless-scroll></endless-scroll>
      
    </section>

    <section class="builders__join join">
      <h3 class="join__title visually-hidden">Форма отправки сообщения</h3>

      <div class="join__form">
        <form class="join-form" autocomplete="off">
          <p class="join-form__block">
            <label aria-label="Поле ввода имени, обязательно для заполнения">
              <input class="join-form__field" name="name" type="text" placeholder="Имя*:" required>
            </label>
          </p>

          <join-autocomplete></join-autocomplete>

          <p class="join-form__block">
            <label aria-label="Поле ввода емэйла">
              <input class="join-form__field" name="email" type="email" placeholder="E-mail:">
            </label>
          </p>
          <p class="join-form__block">
            <label aria-label="Поле ввода номера телефона">
              <input class="join-form__field" name="phone" type="tel" placeholder="Телефон:">
            </label>
          </p>
          <p class="join-form__block">
            <label aria-label="Поле ввода сообщения, обязательно для заполнения">
              <textarea class="join-form__field" name="text" placeholder="Братство - это*:" required></textarea>
            </label>
          </p>
          <p class="join-form__block">
            <span class="join-form__info">* - поля, обязательные для заполнения.</span>
          </p>
          <p class="join-form__block join-form__block--confirm">
            <label aria-label="Согласие с условиями обработки личных данных">
              <input class="join-form__check" name="confirm" type="checkbox">
              <span>Согласие с условиями обработки личных данных</span>
            </label>
          </p>
          <p class="join-form__block join-form__block--recaptcha">

          </p>
          <p class="join-form__block">
            <button class="btn join-form__submit" type="submit">Отправить</button>
          </p>
        </form>

        <button class="join__form-close" type="button" aria-label="Закрыть форму отправки сообщения"></button>
      </div>
    </section>

  </section>

  <section class="builders__search search">
    <h2 class="visually-hidden">Поиск по странице</h2>

    <div class="search__form">

      <search-autocomplete></search-autocomplete>

    </div>
  </section>

</main>






<div id="quake-info">
  <span></span>
</div>

<canvas id="globe-canvas" width="1024" height="1024"></canvas>
@endsection