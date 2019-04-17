<template>
  <div class="admin">
    <app-header></app-header>

    <div class="page-content">
      <app-aside></app-aside>

      <main class="page-main">
        <router-view></router-view>
      </main>
    </div>

    <app-footer></app-footer>
  </div>
</template>


<script>
  export default {

  }

</script>
