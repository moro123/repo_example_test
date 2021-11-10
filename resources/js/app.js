import Vue from 'vue'
import router from './router/vue-router'
import vuetify from './plugins/vuetify'
import store from './store'
import App from './views/App'
import vuescroll from './scroll/vue-scroll'
import vuescrollsmooth from './scroll/vue-scroll-smoth'
import $ from 'jquery'

import Vueditor from 'vueditor'

import 'vueditor/dist/style/vueditor.min.css'

let config = {
    toolbar: [
        'removeFormat', 'undo', '|', 'elements', 'fontName', 'fontSize', 'foreColor', 'backColor', 'divider',
        'bold', 'italic', 'underline', 'strikeThrough', 'links', 'divider', 'subscript', 'superscript',
        'divider', 'justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull', '|', 'indent', 'outdent',
        'insertOrderedList', 'insertUnorderedList', '|', 'picture', 'tables', '|', 'switchView'
    ],
    fontName: [
        { val: 'arial black' }, 
        { val: 'times new roman' }, 
        { val: 'Courier New' }
    ],
    fontSize: [
        '12px', '14px', '16px', '18px', '20px', '24px', '28px', '32px', '36px'
    ],
    uploadUrl: '/post/store-files',
    id: 'editor',
    classList: []
};



Vue.use(Vueditor, config);

const app = new Vue({
    el: '#app',
    components: { App },
    router,
    vuetify,
    store,
    vuescroll,
    $,
    vuescrollsmooth,
    Vueditor
});
