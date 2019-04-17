<template>
  <transition name="modal">
    <div class="modal-overlay">
      <div class="modal">

        <div class="modal-header">
          <slot name="header">
            Вы уверены что хотите удалить?
          </slot>
        </div>

        <div class="modal-body">
          <slot name="body">
          </slot>
        </div>

        <div class="modal-footer">
          <slot name="footer">
            <button class="modal-btn btn" type="button" title="Удалить" @click="$emit('deletePost')">
              Да
            </button>
            <button class="modal-btn btn" type="button" title="Вернуться назад без удаления" @click="$emit('close')">
              Нет
            </button>
          </slot>
        </div>
      </div>
    </div>
  </transition>
</template>

<script>
  export default {
    data() {
      return {}
    }
  }
</script>
