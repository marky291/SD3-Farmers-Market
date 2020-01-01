// add vuew to the window.
window.Vue = require('vue');
import Vue from 'vue';
import axios from 'axios';
import VueAxios from 'vue-axios';
import VueToastr2 from 'vue-toastr-2';
import 'vue-toastr-2/dist/vue-toastr-2.min.css';

// attach notifications to window.
window.toastr = require('toastr');

// use it on vue.
Vue.use(VueAxios, axios);
Vue.use(VueToastr2);

// include the component for the product items cards.
Vue.component('page', require('./Page.vue').default);
Vue.component('product-card', require('./ProductCard').default);
Vue.component('product-view', require('./ProductView').default);
Vue.component('product-timeline', require('./ProductTimelineChart').default);

/**
 * Add the frame for vue.
 */
const app = new Vue({
    el: '#app'
});