
import Vue from 'vue/dist/vue'
import VueResource from 'vue-resource/dist/vue-resource'
import VueRouter from 'vue-router/dist/vue-router'

Vue.use(VueResource);

import VcClinica from './components/clinica.vue'
import VcClinicaedit from './components/clinicaedit.vue'
import VcMedicamento from './components/medicamento.vue'
import VcMedicamentoedit from './components/medicamentoedit.vue'
Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('content');

var app = new Vue({
    el: '#app',
    
    components: {
        VcClinica,
        VcClinicaedit,
        VcMedicamento,        
        VcMedicamentoedit
    }
    
})