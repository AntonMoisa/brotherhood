<template>
  <header class="page-header">
    <div class="page-header__logo logo">
      <a class="logo__link" href="/" aria-label="Ссылка на главную страницу">
        <svg class="logo__img" role="img" width="84px" height="84px">
          <use xlink:href="../../../public/img/svg/sprite.svg#logo"></use>
        </svg>
        <span class="logo__text">Братство</span>
      </a>
    </div>

    <div class="page-header__user user">
      <div class="user__img">
        <img src="../../../public/img/svg/login.svg" alt="Изображение пользователя">
      </div>
      <div class="user__info">
        <p class="user__name">Имя Пользователя</p>
        <p class="user__role">администратор</p>
      </div>
      <div class="user__logout logout">
        <form class="logout-form" id="logout-form" action="/logout" method="POST">
          <input name="_token" type="hidden" :value="csrf">
          <button class="logout__submit" type="submit">
            <svg class="logout__img" role="img" width="40px" height="40px">
              <use xlink:href="../../../public/img/svg/sprite.svg#logout"></use>
            </svg>
            <span class="logout__text">Выход</span>
          </button>
        </form>
      </div>
    </div>
  </header>
</template>

<script>
  import axios from 'axios'

  export default {
    data: () => ({
      csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
    }),
    methods: {
      logout: function() {
        axios.post('/logout').then(response => {
          // if (response.status === 302 || 401) {
          //   self.$router.push('/login')
          //   console.log(true)
          // }
          // else {
          //   // throw error and go to catch block
          // }
        }).catch(error => {

        });
      },
    },
  }

</script>
