// add vuew to the window.
window.Vue = require('vue');
import Vue from 'vue'
import axios from 'axios'
import VueAxios from 'vue-axios'
import AtComponents from 'at-ui'

// use it on vue.
Vue.use(AtComponents);
Vue.use(VueAxios, axios);

// include the component for the product items cards.
Vue.component('product-card', require('./ProductCard').default);
Vue.component('product-view', require('./ProductView').default);
Vue.component('product-timeline', require('./ProductTimelineChart').default);

/**
 * Add the frame for vue.
 */
const app = new Vue({
    el: '#app'
});