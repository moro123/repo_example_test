import Vue from 'vue'
import router from './router/vue-router'
import vuetify from './plugins/vuetify'
import store from './store'
import App from './views/App'
import vuescroll from './scroll/vue-scroll'
import vuescrollsmooth from './scroll/vue-scroll-smoth'
import $ from 'jquery'




const app = new Vue({
    el: '#app',
    components: { App },
    router,
    vuetify,
    store,
    vuescroll,
    $,
    vuescrollsmooth,
});
