
import Vue from 'vue/dist/vue'
import VueResource from 'vue-resource/dist/vue-resource'

Vue.use(VueResource)

import VcLeitos from './components/leitos.vue'

Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('content');

var app = new Vue({
    el: '#app',
    
    components: {
        VcLeitos
    }
    
})