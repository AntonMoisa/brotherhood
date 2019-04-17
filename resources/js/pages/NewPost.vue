<template>
  <section class="section edit">
    <header class="section-header">
      <h2 class="section-header__title edit__title">
        Создание нового материала
      </h2>

      <router-link class="section-close edit__close" type="button" title="Вернуться на предыдущую страницу" tag="button" :to="{name: 'projectModeration', params: {project: project, publish: publish}}">
        <svg class="edit__close-img" role="img" width="20px" height="20px">
          <use xlink:href="../../../public/img/svg/sprite.svg#close"></use>
        </svg>
      </router-link>
    </header>
    <div class="section-body edit__body">

      <div class="edit__form">
        <form class="edit-form">

          <div class="form-section form-section--content">
            <p class="edit-form__block">
              <label class="edit-form__block-title">
                <span>Пользователь</span>
                <input class="edit-form__field" name="searchUser" type="search" placeholder="Имя пользователя" v-model="searchUser" @keyup="searchWordUser" autocomplete="off">
                <input name="_token" type="hidden" :value="csrf">
              </label>

              <ul class="edit-form__result-list" v-if="users.length">
                <li class="edit-form__result-item" v-for="user in users" :key="user.id" @click="selectUser($event)">{{user}}</li>
              </ul>
            </p>

            <p class="edit-form__block">
              <label class="edit-form__block-title">
                <span>Страна</span>
                <input class="edit-form__field" name="searchCountry" type="search" placeholder="Страна" v-model="searchCountry" @keyup="searchWordCountry" autocomplete="off">
                <input name="_token" type="hidden" :value="csrf">
              </label>

              <ul class="search-form__result-list" v-if="countries.length">
                <li class="edit-form__result-item" v-for="country in countries" :key="country.id" @click="selectCountry($event)">{{country}}</li>
              </ul>
            </p>

            <p class="edit-form__block edit-form__block--checkbox">
              <label class="edit-form__block-title">
                <input type="checkbox" value="1" v-model="post.is_published">
                <span>Опубликовать при сохранении</span>
              </label>
            </p>
          </div>

          <div class="form-section form-section--text">
            <p class="edit-form__block">
              <label class="edit-form__block-title">
                <span>Сообщение</span>

                <textarea class="edit-form__field" name="text" v-model="post.text" rows="10"></textarea>
              </label>
            </p>
          </div>

          <p class="edit-form__block edit-form__block--submit">
            <button class="edit-form__btn btn" type="submit" @click.prevent="save">Сохранить</button>
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
        project: this.$route.params['project'],
        publish: this.$route.params['publish'],
        csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        post: [],
        searchCountry: '',
        countries: [],
        searchUser: '',
        users: [],
        usersArray: [],
        userId: '',
      }
    },
    methods: {
      searchWordCountry() {
        this.countries = [];
        axios.post("/admin/projects/" + this.project + "/" + this.publish + "/searchCountry", { params: { search: this.searchCountry } }).then(response => {
          this.countries = response.data;
        })
      },
      selectCountry(event) {
        this.searchCountry = event.target.innerHTML;
        this.countries = [];
      },
      searchWordUser() {
        this.users = [];
        axios.post("/admin/projects/" + this.project + "/" + this.publish + "/searchUser", { params: { search: this.searchUser } }).then(response => {
          response.data.forEach((user) => {
            this.users.push(user.name);
          });
          this.usersArray = response.data;
        })
      },
      selectUser(event) {
        this.searchUser = event.target.innerHTML;
        this.users = [];
        this.usersArray.forEach((user) => {
          if (this.searchUser === user.name) {
            this.post.user_id = user.id
          }
        });
      },
      save() {
        if (this.post.is_published) {
          this.post.is_published = 1;
          this.publish = 'materials';
        } else {
          this.post.is_published = 0;
          this.publish = 'moderate';
        }
        axios.post("/admin/projects/" + this.project + "/" + this.publish + "/createNewPost", {
          text: this.post.text,
          user_id: this.post.user_id,
          is_published: this.post.is_published,
          country: this.searchCountry,
          category: this.project,
        }).then(response => {
          if (response.data === 'success') {
            this.$router.push({
              name: 'projectModeration',
              params: {
                project: this.project,
                publish: this.publish,
              }
            })
          }
        })
      },
    },
    watch: {
      $route(toRoute, fromRoute) {
        this.project = toRoute.params['project'];
        this.publish = toRoute.params['publish'];
      }
    }
  }

</script>
