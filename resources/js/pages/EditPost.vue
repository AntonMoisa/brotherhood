<template>
  <section class="section edit">
    <header class="section-header">
      <h2 class="section-header__title edit__title">
        <span>Редактирование сообщения</span>
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
                <input class="edit-form__field" name="searchUser" type="search" placeholder="Имя пользователя" v-model="searchUser" @keyup="searchWordUser"
                autocomplete="off">
                <input name="_token" type="hidden" :value="csrf">
              </label>

              <ul class="edit-form__result-list" v-if="users.length">
                <li class="edit-form__result-item" v-for="user in users" :key="user.id" @click="selectUser($event)">{{user}}</li>
              </ul>
            </p>

            <p class="edit-form__block">
              <label class="edit-form__block-title">
                <span>Страна</span>
                <input class="edit-form__field" name="searchCountry" type="search" placeholder="Страна" v-model="searchCountry"
                @keyup="searchWordCountry"
                autocomplete="off">
                <input name="_token" type="hidden" :value="csrf">
              </label>

              <ul class="                               " v-if="countries.length">
                <li class="edit-form__result-item" v-for="country in countries" :key="country.id" @click="selectCountry($event)">{{country}}</li>
              </ul>
            </p>

            <p class="edit-form__block">
              <label class="edit-form__block-title">
                <span>Дата создания</span>
                <input class="edit-form__field" name="created" type="text" v-model="post.created_at" disabled>
              </label>
            </p>

            <p class="edit-form__block">
              <label class="edit-form__block-title">
                <span>Дата редактирования</span>
                <input class="edit-form__field" name="created" type="text" v-model="post.updated_at" disabled>
              </label>
            </p>

            <p class="edit-form__block" v-if="isPublished === 1">
              <label class="edit-form__block-title">
                <span>Дата публикации</span>
                <input class="edit-form__field" name="published" type="text" v-model="post.published_at" disabled>
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
            <button class="edit-form__btn btn" type="submit" @click="save">Сохранить</button>

            <button class="edit-form__btn btn" type="button" v-if="isPublished === 0 " @click="rePublish">Опубликовать</button>

            <button class="edit-form__btn btn" type="button" v-else @click="rePublish">Отправить на модерацию</button>
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
        id: this.$route.params['id'],
        project: this.$route.params['project'],
        publish: this.$route.params['publish'],
        csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        post: '',
        searchCountry: '',
        countries: [],
        searchUser: '',
        users: [],
        usersArray: [],
        userId: '',
        oldCountry: '',
        isPublished: '',
        urlPublish: '',
      }
    },
    mounted() {
      this.getPost()
    },
    methods: {
      getPost() {
        axios.get("/admin/projects/" + this.project + "/" + this.publish + "/editPost", { params: { id: this.id, country: this.searchCountry } }).then(response => {
          this.post = response.data;
          this.isPublished = this.post.is_published;
          this.searchCountry = this.post.country.ru;
          this.searchUser = this.post.user.name;
          if (this.oldCountry === '') {
            this.oldCountry = this.searchCountry
          }
        })
      },
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
            this.userId = user.id
          }
        });
      },
      save() {
        if (this.oldCountry === this.searchCountry) {
          this.oldCountry = ''
        } else {
          this.oldCountry = this.searchCountry
        }
        axios.post("/admin/projects/" + this.project + "/" + this.publish + "/updatePost", {
          params: {
            id: this.id,
            userId: this.userId,
            country: this.oldCountry,
            text: this.post.text
          }
        }).then(response => {
          if (response.statusText === 'OK') {
            this.$router.push({
              name: 'editPost',
              params: {
                project: this.project,
                publish: this.publish,
                id: this.id
              }
            })
          }
        })
      },
      rePublish() {
        if (this.isPublished === 0) {
          this.isPublished = 1
        } else {
          this.isPublished = 0
        }
        if (this.publish === 'moderation') {
          this.urlPublish = 'materials'
        } else {
          this.urlPublish = 'moderation'
        }
        axios.get("/admin/projects/" + this.project + "/" + this.urlPublish + "/rePublish", { params: { id: this.id, is_published: this.isPublished } }).then(response => {
          if (response.statusText === 'OK') {
            this.$router.push({
              name: 'editPost',
              params: {
                project: this.project,
                publish: this.urlPublish,
                id: this.id
              }
            })
          }
        })
      }
    },
    watch: {
      $route(toRoute, fromRoute) {
        this.project = toRoute.params['project'];
        this.publish = toRoute.params['publish'];
        this.id = toRoute.params['id'];
      }
    },
  }
</script>
