import Vue from 'vue'
import App from './App.vue'
import VueRouter from 'vue-router'
import router from './routes'

export const eventEmitter = new Vue();

Vue.use(VueRouter);

Vue.component('app-header', require('./components/Header.vue').default);
Vue.component('app-footer', require('./components/Footer.vue').default);
Vue.component('app-aside', require('./components/Aside.vue').default);
Vue.component('app-asideLiProject', require('./components/AsideLiProject.vue').default);
Vue.component('app-deleteModal', require('./components/DeleteModal.vue').default);

new Vue({
    el: '#admin',
    render: h => h(App),
    router
});
