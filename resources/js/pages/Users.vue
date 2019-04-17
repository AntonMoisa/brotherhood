<template>
  <section class="section users">
    <header class="section-header">
      <h2 class="section-header__title users__title">Пользователи</h2>

      <div class="users__serch search">
        <form class="search-form" @keydown.enter.prevent>
          <div class="search__block">
            <input name="text" type="text" v-model="selectedSearch" @keyup="searchWithOption">
            <select name="category" v-model="selected">
              <option v-for="option in options" :key="option.id" :value="option.value">
                {{ option.text }}
              </option>
            </select>
          </div>
        </form>
      </div>
    </header>

    <div class="section-body users__body">
      <div class="users__table users-table">
        <table>
          <thead>
            <tr>
              <th>Имя</th>
              <th>Email</th>
              <th>Страна</th>
              <th>Телефон</th>
              <th>Роль</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="user in users">
              <td :value="user.name">{{ user.name }}</td>
              <td :value="user.email"><a :href="'mailto:' + user.email">{{ user.email }}</a></td>
              <td :value="user.country">{{ user.country }}</td>
              <td :value="user.phone"><a :href="'tel:+' + user.phone">{{ user.phone }}</a></td>
              <td :value="user.roles">{{ user.roles }}</td>

              <td class="users-table__controls table-controls">
                <ul class="table-controls__list">
                  <li class="table-controls__item">
                    <button class="table-controls__btn" type="button" title="Удалить пользователя" @click="setPosId(user.id)">
                      <svg class="table-controls__item-img" role="img" width="20px" height="20px">
                        <use xlink:href="../../../public/img/svg/sprite.svg#user-delete"></use>
                      </svg>
                    </button>
                  </li>

                  <li class="table-controls__item">
                    <button class="table-controls__btn" type="button" title="Блокировать пользователя">
                      <svg class="table-controls__item-img" role="img" width="20px" height="20px">
                        <use xlink:href="../../../public/img/svg/sprite.svg#user-block"></use>
                      </svg>
                    </button>
                  </li>

                  <li class="table-controls__item">
                    <router-link class="table-controls__btn" type="button" title="Настройки пользователя" tag="button" :to="{name: 'editUser', params: {id: user.id }}">
                      <svg class="table-controls__item-img" role="img" width="20px" height="20px">
                        <use xlink:href="../../../public/img/svg/sprite.svg#user-settings"></use>
                      </svg>
                    </router-link>
                  </li>
                </ul>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="users__new">
        <router-link class="users__new-btn btn" tag="button" :to="{name: 'newUser'}">
          <svg role="img" width="20px" height="20px">
            <use xlink:href="../../../public/img/svg/sprite.svg#user-add"></use>
          </svg>
          <span>Создать пользователя</span>
        </router-link>
      </div>

      <div class="user__pagination pagination">
        <button class="btn pagination__btn pagination__btn--prev" @click="fetchPaginateUsers(pagination.prev_page_url)" :disabled="!pagination.prev_page_url">
          Previos
        </button>
        <span class="pagination__info">Page {{pagination.current_page}} of {{pagination.last_page}}</span>
        <button class="btn pagination__btn pagination__btn--next" @click="fetchPaginateUsers(pagination.next_page_url)" :disabled="!pagination.next_page_url">
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

  export default {
    data() {
      return {
        users: [],
        selectedSearch: '',
        selected: 'users.name',
        options: [
          { text: 'Поиск по пользователям', value: 'users.name' },
          { text: 'Поиск по email', value: 'users.email' },
          { text: 'Поиск по странам', value: 'countries.ru' },
          { text: 'Поиск по телефону', value: 'users.phone' }
        ],
        url: '/admin/users/show',
        pagination: [],
        showModal: false,
        deletePostId: '',
      }
    },
    beforeMount() {
      this.getUsers()
    },
    methods: {
      getUsers() {
        let $this = this;
        axios.get(this.url, {
          params: {
            selected: this.selected,
            selectedSearch: this.selectedSearch
          }
        }).then(response => {
          this.users = [];
          this.users = response.data.data;
          $this.makePagination(response.data)
        })
      },
      searchWithOption() {
        this.getUsers()
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
      fetchPaginateUsers(url) {
        this.url = url;
        this.getUsers()
      },
      deletePost(deletePostId) {
        this.showModal = false;
        axios.get("/admin/users/deleteUser", { params: { id: deletePostId } }).then(response => {
          if (response.data === 'success') {
            this.getUsers();
          }
        })
      },
      setPosId(PostId) {
        this.showModal = true;
        this.deletePostId = PostId
      },
    }
  }

</script>
