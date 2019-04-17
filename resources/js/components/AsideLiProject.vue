<template>
  <li class="submenu__item submenu">
    <h4 class="submenu__title" :class="{ active: visible }" @click="visible = !visible">{{ project.title }}</h4>

    <ul class="submenu__list" v-show="visible" v-for="option in options" :key="option.id" @click="reloadData">
      <router-link class="submenu__item" tag="li" :to="'/admin/projects/' + project.slug + '/' + option.url" active-class="active">
        <a class="submenu__link">{{option.text}}</a>
      </router-link>
    </ul>
  </li>
</template>

<script>
  import { eventEmitter } from '../admin'

  export default {
    props: ['project'],
    data() {
      return {
        visible: false,
        options: [
          { url: 'moderation', text: 'Модерация' },
          { url: 'materials', text: 'Материалы' },
        ]
      }
    },
    methods: {
      reloadData() {
        eventEmitter.$emit('updateData')
      },
    },
  }

</script>
