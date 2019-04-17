@extends('frontend.layouts.login')

@section('content')
<section class="login">
  <h1 class="visually-hidden">Страница авторизации пользователя</h1>
  <div class="login__form">
    <h2 class="login__form-title">Войти в систему</h2>

    <form class="login-form">
      <p class="login-form__block">
        <label>
          <span class="login-form__block-title">E-mail</span>
          <input class="login-form__field" name="email" type="email" required>
        </label>
      </p>
      <p class="login-form__block">
        <label>
          <span class="login-form__block-title">Пароль</span>
          <input class="login-form__field" name="password" type="password" required>
        </label>
      </p>
      <p class="login-form__block login-form__block--recaptcha">
        <span class="g-recaptcha" data-sitekey="{{env('CAPTCHA_KEY')}}"></span>
          @if($errors->has('g-recaptcha-response'))
            <span class="invalid-feedback" style="display: block;">
              <strong>{{$errors->first('g-recaptcha-response')}}</strong>
            </span>
          @endif
      </p>
      <p class="login-form__block login-form__block--submit">
        <button class="login-form__submit" type="sybmit">Войти</button>
      </p>
      <p class="login-form__block login-form__block--forget">
        <a class="login-form__link" href="#">Забыли пароль?</a>
      </p>
    </form>
  </div>
</section>
@endsection
