require('./bootstrap');
window.Vue = require('vue').default;
import Vue from "vue";
import vSelect from "vue-select";

import vuetify from './vuetify';
import 'vuetify/dist/vuetify.min.css'
import "vue-select/dist/vue-select.css";

import { BootstrapVue,BCard , BootstrapVueIcons } from 'bootstrap-vue'
Vue.use(BootstrapVue);
Vue.use(BootstrapVueIcons)

import VueApexCharts from 'vue-apexcharts'

Vue.use(VueApexCharts)


Vue.component("v-select", vSelect);
Vue.component('b-card', BCard)

Vue.component('tabla-empleado', require('./components/tabla.vue').default);
Vue.component('nueva-cita', require('./views/NuevaCita.vue').default);
Vue.component('home', require('./views/home.vue').default);
Vue.component('usuario', require('./views/usuario.vue').default);
Vue.component('reporte', require('./views/reporte.vue').default);
Vue.component('clientes', require('./views/Clientes.vue').default);
Vue.component('empleados', require('./views/Empleados.vue').default);

const app = new Vue({
    vuetify,
    el: '#app'  
    
});