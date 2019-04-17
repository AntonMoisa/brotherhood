<template>
  <section class="section quotes">
    <header class="section-header">
      <h2 class="section-header__title quotes__title">Сообщения на планете</h2>
    </header>
    <div class="section-body quotes__body">
      <div class="quotes__table quotes-table">
        <table>
          <thead>
            <tr>
              <th>Текст цитаты</th>
              <th>Координата 1</th>
              <th>Координата 2</th>
              <th>
              </th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(message, index) in quotes" :key="message.id">
              <td>
                {{message.properties.place}}
              </td>
              <td>
                {{message.geometry.coordinates[0]}}
              </td>
              <td>
                {{message.geometry.coordinates[1]}}
              </td>
              <td class="quotes-table__controls table-controls">
                <ul class="table-controls__list">
                  <li class="table-controls__item">
                    <router-link class="table-controls__btn" type="button" title="Редактировать цитату" tag="button" :to="{name: 'editCoordinate', params: {id: index }}">
                      <svg class="table-controls__item-img" role="img" width="20px" height="20px">
                        <use xlink:href="../../../public/img/svg/sprite.svg#edit"></use>
                      </svg>
                    </router-link>
                  </li>

                  <li class="table-controls__item">
                    <button class="table-controls__btn" type="button" title="Удалить цитату" @click="setMessageId(index)">
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

      <div class="quotes__new">
        <router-link class="quotes__new-btn btn" tag="button" :to="{name: 'newCoordinate'}">
          <svg role="img" width="20px" height="20px">
            <use xlink:href="../../../public/img/svg/sprite.svg#edit"></use>
          </svg>
          <span>Создать новую цитату</span>
        </router-link>
      </div>
    </div>

    <div class="confirm-modal" v-if="showModal">
      <app-deleteModal @close="showModal = false" @deletePost="deleteMessage(deleteMessageId)"></app-deleteModal>
    </div>
  </section>
</template>

<script>
  import axios from 'axios'
  export default {
    data() {
      return {
        newItem: '',
        text: '',
        coordinate1: '',
        coordinate2: '',
        quotes: [],
        showModal: false,
        deleteMessageId: '',
      }
    },
    beforeMount() {
      this.updateCoordinateSettings()
    },
    methods: {
      updateCoordinateSettings() {
        axios.get("/admin/settings/coordinate", {
          params: {
            text: this.text,
            coordinate1: this.coordinate1,
            coordinate2: this.coordinate2,
            quotes: this.quotes
          }
        }).then(response => {
          this.quotes = response.data
          this.newItem = response.data.length
        })
      },
      deleteMessage(deleteMessageId) {
        this.showModal = false;
        axios.get("/admin/settings/deleteCoordinate", {
          params: {
            id: deleteMessageId
          }
        }).then(response => {
          if (response.data === 'success') {
            this.updateCoordinateSettings()
          }
        })
      },
      setMessageId(MessageId) {
        this.showModal = true;
        this.deleteMessageId = MessageId
      },
    },
  }

</script>
