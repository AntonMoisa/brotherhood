<template>
  <section class="section project">
    <header class="section-header">
      <h2 class="section-header__title project__title" v-if="publish === 'materials'">
        Материалы
      </h2>
      <h2 class="section-header__title project__title" v-else>
        Модерация
      </h2>

      <div class="project__serch">
        <form class="search-form" autocomplete="off">
          <p class="search-form__block">
            <label aria-label="Искать на странице">
              <input name="search" type="search" placeholder="Поиск по странам" v-model="search" @keyup="searchWord">
              <input name="_token" type="hidden" :value="csrf">
            </label>
            <ul class="search-form__result-list" v-if="countries.length">
              <li class="search-form__result-item" v-for="country in countries" :key="country.id" @click="selectCountry($event)">{{country}}</li>
            </ul>
          </p>
        </form>
      </div>
    </header>

    <div class="section-body project__body">
      <div class="project__table project-table">
        <table>
          <thead>
            <tr>
              <th style="width: 20%">Имя</th>
              <th style="width: 15%">Страна</th>
              <th>Цитата</th>
              <th>
              </th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="post in posts" :key="post.id">
              <td>{{ post.name }}</td>
              <td>{{ post.ru }}</td>
              <td>{{ post.text }}</td>
              <td class="project-table__controls table-controls">
                <ul class="table-controls__list">
                  <li class="table-controls__item">
                    <button class="table-controls__btn" type="button" title="Утвердить сообщение" v-if="post.is_published === 0" @click="rePublish(post.id)">
                      <svg class="table-controls__item-img" role="img" width="20px" height="20px">
                        <use xlink:href="../../../public/img/svg/sprite.svg#confirm"></use>
                      </svg>
                    </button>
                  </li>

                  <li class="table-controls__item">
                    <router-link class="table-controls__btn" type="button" title="Редактировать сообщение" tag="button" :to="{name: 'editPost', params: {project: project, publish: publish, id: post.id }}">
                      <svg class="table-controls__item-img" role="img" width="20px" height="20px">
                        <use xlink:href="../../../public/img/svg/sprite.svg#edit"></use>
                      </svg>
                    </router-link>
                  </li>

                  <li class="table-controls__item">
                    <button class="table-controls__btn" type="button" title="Удалить сообщение" @click="setPosId(post.id)">
                      <svg class="table-controls__item-img" role="img" width="20px" height="20px">
                        <use xlink:href="../../../public/img/svg/sprite.svg#remove"></use>
                      </svg>
                    </button>
                  </li>
                </ul>
              </td>

            </tr>
          </tbody>
        </table>
      </div>

      <div class="project__new" v-if="publish === 'materials'">
        <router-link class="project__new-btn btn" tag="button" :to="{name: 'newPost'}">
          <svg role="img" width="20px" height="20px">
            <use xlink:href="../../../public/img/svg/sprite.svg#edit"></use>
          </svg>
          <span>Создать сообщение</span>
        </router-link>
      </div>

      <div class="project__pagination pagination">
        <button class="btn pagination__btn pagination__btn--prev" @click="fetchPaginateproject(pagination.prev_page_url)" :disabled="!pagination.prev_page_url">
          Previos
        </button>
        <span class="pagination__info">Page {{pagination.current_page}} of {{pagination.last_page}}</span>
        <button class="btn pagination__btn pagination__btn--next" @click="fetchPaginateproject(pagination.next_page_url)" :disabled="!pagination.next_page_url">
          Next
        </button>
      </div>
    </div>

    <div class="confirm-modal" v-if="showModal">
      <app-deleteModal @close="showModal = false" @deletePost="deletePost(deletePostId)"></app-deleteModal>
    </div>
  </section>
</template>

<script>
  import axios from 'axios'
  import { eventEmitter } from '../admin'

  export default {
    data() {
      return {
        project: this.$route.params['project'],
        publish: this.$route.params['publish'],
        posts: [],
        pagination: [],
        url: '',
        search: '',
        countries: [],
        csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        editUrl: '',
        showModal: false,
        deletePostId: '',
      }
    },
    mounted() {
      this.url = "/admin/projects/" + this.project + "/" + this.publish + "/posts";
      this.getAllPosts()
    },
    methods: {
      searchWord() {
        this.countries = [];
        axios.post("/admin/projects/" + this.project + "/" + this.publish + "/searchCountry", { params: { search: this.search } }).then(response => {
          this.countries = response.data;
        })
      },
      selectCountry(event) {
        this.search = event.target.innerHTML;
        this.countries = [];
        this.getAllPosts();
      },
      getAllPosts() {
        let $this = this;
        this.editUrl = "/admin/projects/" + this.project + "/" + this.publish + "/editPost";
        axios.get(this.url, { params: { publish: this.publish, project: this.project, country: this.search } }).then(response => {
          this.posts = response.data.data;
          $this.makePagination(response.data);
        })
      },
      makePagination(data) {
        let pagination = {
          current_page: data.current_page,
          last_page: data.last_page,
          next_page_url: data.next_page_url,
          prev_page_url: data.prev_page_url
        };
        this.pagination = pagination
      },
      fetchPaginateproject(url) {
        this.url = url;
        this.getAllPosts()
      },
      deletePost(deletePostId) {
        this.showModal = false;
        axios.get("/admin/projects/" + this.project + "/" + this.publish + "/deletePost", { params: { id: deletePostId } }).then(response => {
          if (response.data === 'success') {
            this.getAllPosts()
          }
        })
      },
      setPosId(PostId) {
        this.showModal = true;
        this.deletePostId = PostId
      },
      rePublish(postId) {
        axios.get("/admin/projects/" + this.project + "/" + this.publish + "/rePublish", { params: { id: postId, is_published: 1 } }).then(response => {
          if (response.statusText === 'OK') {
            this.getAllPosts()
          }
        })
      }
    },
    watch: {
      $route(toRoute) {
        this.project = toRoute.params['project'];
        this.publish = toRoute.params['publish']
      }
    },
    created() {
      eventEmitter.$on('updateData', () => {
        this.getAllPosts()
      })
    },
  }

</script>
