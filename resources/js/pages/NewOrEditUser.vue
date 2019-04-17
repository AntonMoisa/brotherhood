<template>
  <section class="section edit">
    <header class="section-header">
      <h2 class="section-header__title edit__title" v-if="id === ''">
        Создание нового пользователя
      </h2>

      <h2 class="section-header__title edit__title" v-if="id !== ''">
        Редактирование пользователя
      </h2>

      <button class="section-close edit__close" type="button" aria-label="Вернуться на предыдущую страницу" @click="$router.push({ name: 'users' })">
        <svg class="edit__close-img" role="img" width="20px" height="20px">
          <use xlink:href="../../../public/img/svg/sprite.svg#close"></use>
        </svg>
      </button>
    </header>

    <div class="section-body edit__body">
      <div class="edit__form">
        <div v-if="error !== ''">
          <span style="color: red">Заполните поля</span>
        </div>

        <form class="edit-form">
          <p class="edit-form__block">
            <label class="edit-form__block-title">
              <span>Роль</span>
              <select class="edit-form__field" name="roles" v-model="roles">
                <option value="1">User</option>
                <option value="2">Admin</option>
                <option value="3">Moderator</option>
              </select>
            </label>
          </p>

          <p class="edit-form__block">
            <label class="edit-form__block-title">
              <span>Страна</span>
              <input class="edit-form__field" name="country" type="text" v-model="searchCountry" @keyup="searchWordCountry" autocomplete="off">
            </label>
            <ul class="edit-form__result-list" v-if="countries.length">
              <li class="edit-form__result-item" v-for="country in countries" @click="selectCountry($event)" :key="country.id">{{ country }}</li>
            </ul>
          </p>

          <p class="edit-form__block">
            <label class="edit-form__block-title">
              <span>Имя</span>
              <input class="edit-form__field" name="user" type="text" v-model="user.name">
            </label>
          </p>

          <p class="edit-form__block">
            <label class="edit-form__block-title">
              <span>Email</span>
              <input class="edit-form__field" name="email" type="text" v-model="user.email">
            </label>
          </p>

          <p class="edit-form__block">
            <label class="edit-form__block-title">
              <span>Телефон</span>
              <input class="edit-form__field" name="phone" type="number" v-model.number="user.phone">
            </label>
          </p>

          <p class="edit-form__block">
            <label class="edit-form__block-title">
              <span>Пароль</span>
              <input class="edit-form__field" name="password" type="text" v-model="password" placeholder="Новый пароль">
            </label>
          </p>

          <p class="edit-form__block" v-if="password !== ''">
            <label class="edit-form__block-title">
              <span>Подтверждение пароля</span>
              <input class="edit-form__field" name="confirm-password" type="text" v-model.lazy="acceptPassword" placeholder="Подтверждение пароля">
              <span v-if="acceptPassword !== password && acceptPassword !== ''">Пароли не совпадают</span>
            </label>
          </p>

          <p class="edit-form__block edit-form__block--submit">
            <button class="edit-form__btn btn" type="submuit" @click.prevent="save">Сохранить изменения</button>
          </p>
        </form>
      </div>
    </div>
  </section>
</template>

<script>
  import axios from 'axios'

  export default {
    data() {
      return {
        id: '',
        csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        searchCountry: '',
        countries: [],
        roles: [],
        user: {
          name: '',
          email: '',
          phone: '',
          createdAt: '',
          updatedAt: '',
          password: ''
        },
        password: '',
        acceptPassword: '',
        error: '',
      }
    },
    beforeMount() {
      if (this.$route.params['id']) {
        this.id = this.$route.params['id']
      }
      this.getUser()
    },
    methods: {
      getUser() {
        axios.get('/admin/users/newOrEditUser', { params: { id: this.id } }).then(response => {
          if (response.data.user) {
            this.user.name = response.data.user[0].name;
            this.user.email = response.data.user[0].email;
            this.user.phone = response.data.user[0].phone;
            this.user.createdAt = response.data.user[0].createdAt;
            this.user.updatedAt = response.data.user[0].updatedAt;
            this.searchCountry = response.data.user[0].countryName;
            this.roles = response.data.user[0].rolesId;
          }
        })
      },
      searchWordCountry() {
        this.countries = [];
        axios.post("/admin/projects/materials/builders/searchCountry", { params: { search: this.searchCountry } }).then(response => {
          this.countries = response.data;
        })
      },
      selectCountry(event) {
        this.searchCountry = event.target.innerHTML;
        this.countries = [];
      },
      save() {
        if (this.acceptPassword === this.password) {
          this.user.password = this.acceptPassword
        }
        if (this.id === '') {
          this.createUser()
        }
        if (this.error === '') {
          axios.post("/admin/user/update", {
            id: this.id,
            user: this.user,
            country: this.searchCountry,
            role: this.roles
          }).then(response => {
            this.$router.push({ name: 'users' })
          })
        }
      },
      createUser() {
        if (
          this.user.name === '' ||
          this.user.email === '' ||
          this.roles === '' ||
          this.searchCountry === '' ||
          this.acceptPassword !== this.password
        ) {
          this.error = 'error'
        } else {
          this.error = ''
        }
      }
    }
  }
</script>