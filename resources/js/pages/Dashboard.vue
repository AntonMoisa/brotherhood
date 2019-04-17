<template>
  <section class="section dashboard">
    <header class="section-header">
      <h2 class="section-header__title dashboard__title visually-hidden">Панель с общей статистикой</h2>
    </header>
    <div class="section-body dashboard__body">
      <ul class="dashboard__list">
        <li class="dashboard__item dashboard-item dashboard-item--comments">
          <a class="dashboard-item__link" href="/admin/projects/builders/materials">
            <span class="dashboard-item__count" v-model="published">{{ published }}</span>
            <h3 class="dashboard-item__title" >Количество <br> комментариев</h3>
          </a>
        </li>
        <li class="dashboard__item dashboard-item dashboard-item--users">
          <a class="dashboard-item__link" href="/admin/users">
            <span class="dashboard-item__count" v-model="count_users">{{ count_users }}</span>
            <h3 class="dashboard-item__title">Количество <br> пользователей</h3>
          </a>
        </li>
        <li class="dashboard__item dashboard-item dashboard-item--unmoderated">
          <a class="dashboard-item__link" href="/admin/projects/builders/moderation">
            <span class="dashboard-item__count" v-model="on_moderate">{{ on_moderate }}</span>
            <h3 class="dashboard-item__title">Неотмодерированные <br> комментарии</h3>
          </a>
        </li>
      </ul>
    </div>
  </section>
</template>

<script>
  import axios from 'axios'
  export default {
    data() {
      return {
        url: '/admin/dashboard/project_cards',
        published: '',
        count_users: '',
        on_moderate: '',
      }
    },
    beforeMount() {
      this.getProjectCards()
    },
    methods: {
      getProjectCards() {
        axios.get( this.url ).then(response => {
          this.published = response.data.published
          this.count_users = response.data.count_users
          this.on_moderate = response.data.on_moderate
        })
      }
    }
  }
</script>
