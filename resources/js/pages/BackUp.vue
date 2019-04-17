<template>
  <section class="section backup">
    <header class="section-header">
      <h2 class="section-header__title backup__title">Резервирование и восстановление</h2>
    </header>

    <div class="section-body backup__body">
      <a class="backup__link btn" :href="backup" download>
        <svg class="backup__link-img" role="img" width="40px" height="40px">
          <use xlink:href="../../../public/img/svg/sprite.svg#backup"></use>
        </svg>
        Скачать и создать резервную копию
      </a>
    </div>
  </section>
</template>

<script>
  export default {
    data() {
      return {
        backup: '/admin/settings/databaseBackup',
      }
    }
  }
</script>
