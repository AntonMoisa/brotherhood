<template>
  <aside class="page-aside">
    <nav class="nav">
      <ul class="nav__list">
        <router-link class="nav__item" tag="li" to="/admin/dashboard" active-class="active">
          <a class="nav__link">
            <svg class="nav__link-img" role="img" width="30px" height="30px">
              <use xlink:href="../../../public/img/svg/sprite.svg#panel"></use>
            </svg>
            <span class="nav__link-text">Панель</span>
          </a>
        </router-link>

        <router-link class="nav__item" tag="li" to="/admin/users" active-class="active">
          <a class="nav__link">
            <svg class="nav__link-img" role="img" width="30px" height="30px">
              <use xlink:href="../../../public/img/svg/sprite.svg#users"></use>
            </svg>
            <span class="nav__link-text">Пользователи</span>
          </a>
        </router-link>

        <li class="nav__item submenu">
          <h3 class="submenu__title" :class="{ active: show }" @click="show = !show">
            <svg class="submenu__img" role="img" width="30px" height="30px">
              <use xlink:href="../../../public/img/svg/sprite.svg#projects"></use>
            </svg>
            Проекты
          </h3>

          <ul class="submenu__list" v-show="show">

            <app-asideLiProject v-for="project in projects" :key="project.id" :project="project"></app-asideLiProject>

          </ul>
        </li>

        <li class="nav__item submenu">
          <h3 class="submenu__title" :class="{ active: visible }" @click="visible = !visible">
            <svg class="submenu__img" role="img" width="30px" height="30px">
              <use xlink:href="../../../public/img/svg/sprite.svg#control"></use>
            </svg>
            Управление интерфейсом
          </h3>

          <ul class="submenu__list" v-show="visible">

            <router-link class="submenu__item" tag="li" to="/admin/email-settings" active-class="active">
              <a class="submenu__link">
                Настройки почты
              </a>
            </router-link>

            <router-link class="submenu__item" tag="li" to="/admin/backup" active-class="active">
              <a class="submenu__link">
                Бэкап
              </a>
            </router-link>

            <router-link class="submenu__item" tag="li" to="/admin/messageOnEarth" active-class="active">
              <a class="submenu__link">
                Сообщения на планете
              </a>
            </router-link>
          </ul>
        </li>
      </ul>
    </nav>
  </aside>
</template>

<script>
  import axios from 'axios'

  export default {
    data() {
      return {
        projects: '',
        show: false,
        visible: false,
        url: '/admin/projects/project_slug',
        backup: '/admin/settings/databaseBackup',
      }
    },
    beforeMount() {
      this.getProjects()
    },
    methods: {
      getProjects() {
        axios.get(this.url).then(response => {
          this.projects = response.data
        })
      },
    }
  }

</script>
