@extends('forum.layouts.inner')
@include('forum.modules.header')
@section('content')
  <main class="page-content builders container" id="app">
    <section class="builders__intro">
      <h1 data-title="{{$category->id}}" class="page-title builders__intro-title">
      {{__('project.builders.project_name.'.$category->id)}}
      </h1>
      <b class="page-subtitle builders__intro-subtitle">@lang('project.builders.count') <span>{{$count_user}}</span>
      </b>

      <button class="btn builders__join-btn">@lang('project.builders.invite')</button>
    </section>

    <section class="builders__content">
      <h2 class="visually-hidden">Основной контент на странице</h2>

      <section class="builders__quotes quotes active">
        <h3 class="quotes__title">@lang('project.builders.project_is')</h3>

        <endless-scroll :project="{{$category->id}}"></endless-scroll>

      </section>

      <section class="builders__join join">
        <h3 class="join__title visually-hidden">@lang('project.builders.form')</h3>

        <div class="join__form">
          <form action="{{route('forum.project.new_post', $category->id)}}" method="POST" class="join-form" autocomplete="off">

            @csrf

            <p class="join-form__block">
              <label aria-label="Поле ввода имени, обязательно для заполнения">
                <input class="join-form__field" name="name" type="text" placeholder="@lang('project.builders.name')*:" required>
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
                <input class="join-form__field" name="phone" type="tel" placeholder="@lang('project.builders.phone'):">
              </label>
            </p>
            <p class="join-form__block">
              <label aria-label="Поле ввода сообщения, обязательно для заполнения" style="font-size: 1.6875rem">
                @lang('project.builders.project_is')*:
                <textarea class="join-form__field" name="text" required></textarea>
              </label>
            </p>
            <p class="join-form__block">
              <span class="join-form__info">* - @lang('project.builders.required').</span>
            </p>
            <p class="join-form__block join-form__block--confirm">
              <label aria-label="Согласие с условиями обработки личных данных">
                <input class="join-form__check" name="confirm" type="checkbox">
                <span>@lang('project.builders.consent')</span>
              </label>
            </p>
            <p class="join-form__block join-form__block--recaptcha">
              <span class="g-recaptcha" data-sitekey="{{env('CAPTCHA_KEY')}}"></span>
              @if($errors->has('g-recaptcha-response'))
                <span class="invalid-feedback" style="display: block;">
                  <strong>{{$errors->first('g-recaptcha-response')}}</strong>
                </span>
              @endif
            </p>
            <p class="join-form__block">
              <button class="btn join-form__submit" type="submit">@lang('project.builders.send')</button>
            </p>
          </form>

          <button class="join__form-close" type="button" aria-label="Закрыть форму отправки сообщения"></button>
        </div>
      </section>

    </section>

    <section class="builders__search search">
      <h2 class="visually-hidden">Поиск по странице</h2>

      <div class="search__form">

        <search-autocomplete :project="{{$category->id}}"></search-autocomplete>

      </div>
    </section>

  </main>

  <div id="quake-info">
    <span></span>
  </div>

  <canvas id="globe-canvas" width="1024" height="1024"></canvas>
@endsection