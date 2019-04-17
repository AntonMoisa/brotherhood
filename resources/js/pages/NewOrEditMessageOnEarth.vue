<template>
  <section class="section edit">
    <header class="section-header">
      <h2 class="section-header__title edit__title" v-if="id === ''">Добавить новую цитату</h2>
      <h2 class="section-header__title edit__title" v-if="id !== ''">Редактировать цитату</h2>

      <button class="section-close edit__close" type="button" aria-label="Вернуться на предыдущую страницу" @click="$router.push({ name: 'messageOnEarth' })">
        <svg class="edit__close-img" role="img" width="20px" height="20px">
          <use xlink:href="../../../public/img/svg/sprite.svg#close"></use>
        </svg>
      </button>
    </header>

    <div class="section-body edit__body">
      <div class="edit__form">
        <form class="edit-form">
          <p class="edit-form__block">
            <label class="edit-form__block-title">
              <span>Тексты цитаты</span>

              <textarea class="edit-form__field" name="quote" v-model="text" rows="5"></textarea>
            </label>
          </p>

          <p class="edit-form__block">
            <label class="edit-form__block-title">
              <span>Координата 1</span>
              <input class="edit-form__field" name="coordinate1" type="text" v-model="coordinate1">
            </label>
          </p>

          <p class="edit-form__block">
            <label class="edit-form__block-title">
              <span>Координата 2</span>
              <input class="edit-form__field" name="coordinate2" type="text" v-model="coordinate2">
            </label>
          </p>

          <p class="edit-form__block edit-form__block--submit">
            <button class="edit-form__btn btn" type="submit" @click="updateCoordinate">Сохранить</button>
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
        url: '',
        text: '',
        coordinate1: '',
        coordinate2: '',
      }
    },
    mounted() {
      if (this.$route.params['id'] !== undefined) {
        this.id = this.$route.params['id'];
        this.url = 'editCoordinate';
        this.updateCoordinate()
      } else {
        this.url = 'newCoordinate'
      }
    },
    methods: {
      updateCoordinate() {
        axios.get("/admin/settings/" + this.url, {
          params: {
            id: this.id,
            text: this.text,
            coordinate1: this.coordinate1,
            coordinate2: this.coordinate2,
          }
        }).then(response => {
          if (response.data === 'success') {
            this.$router.go(-1)
          }
          if (this.id !== '') {
            this.text = response.data.properties.place;
            this.coordinate1 = response.data.geometry.coordinates[0];
            this.coordinate2 = response.data.geometry.coordinates[1]
          }
        })
      },
    },
  }
</script>
