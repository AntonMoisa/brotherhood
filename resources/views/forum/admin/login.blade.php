@extends('forum.admin.layouts.login')

@section('content')
<section class="login">
  <h1 class="visually-hidden">Страница авторизации пользователя</h1>
  <div class="login__form">
    <h2 class="login__form-title">Войти в систему</h2>

    <form method="POST" action="{{ route('login') }}" class="login-form">
      @csrf

      <p class="login-form__block">
        <label>
          <span class="login-form__block-title">E-mail</span>
          <input class="login-form__field form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" type="email" name="email" value="{{ old('email') }}" required autofocus>
          @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('email') }}</strong>
            </span>
          @endif
        </label>
      </p>
      <p class="login-form__block">
        <label>
          <span class="login-form__block-title">Пароль</span>
          <input id="password" class="login-form__field form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" name="password" required>
        @if ($errors->has('password'))
            <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('password') }}</strong>
            </span>
          @endif
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
