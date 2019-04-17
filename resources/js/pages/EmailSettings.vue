<template>
  <section class="section edit">
    <header class="section-header">
      <h2 class="section-header__title edit__title">Настройки почты</h2>
    </header>

    <div class="section-body edit__body">
      <div class="edit__form">
        <form class="edit-form">

          <p class="edit-form__block">
            <label class="edit-form__block-title">
              <span>Почта отправителя</span>
              <input class="edit-form__field" name="user-email" type="text" v-model="MAIL_USERNAME">
            </label>
          </p>

          <p class="edit-form__block">
            <label class="edit-form__block-title">
              <span>Пароль отправителя</span>
              <input class="edit-form__field" name="user-password" type="password" v-model="MAIL_PASSWORD">
            </label>
          </p>

          <p class="edit-form__block">
            <label class="edit-form__block-title">
              <span>Почта получателя</span>
              <input class="edit-form__field" name="admin-email" type="text" v-model="MAIL_ADMIN">
            </label>
          </p>

          <p class="edit-form__block edit-form__block--submit">
            <button class="edit-form__btn btn" type="submuit" @click="updateMailSettings">Сохранить изменения</button>
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
        MAIL_USERNAME: '',
        MAIL_PASSWORD: '',
        MAIL_ADMIN: '',
      }
    },
    beforeMount() {
      this.updateMailSettings()
    },
    methods: {
      updateMailSettings() {
        axios.get("/admin/settings/mail", {
          params: {
            MAIL_USERNAME: this.MAIL_USERNAME,
            MAIL_PASSWORD: this.MAIL_PASSWORD,
            MAIL_ADMIN: this.MAIL_ADMIN
          }
        }).then(response => {
          this.MAIL_USERNAME = response.data.MAIL_USERNAME,
            this.MAIL_PASSWORD = response.data.MAIL_PASSWORD,
            this.MAIL_ADMIN = response.data.MAIL_ADMIN
        })
      },
    },
  }
</script>
