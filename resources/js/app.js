window.Vue = require('vue');

Vue.component('product-card', require('./ProductCard.vue').default);

/**
 * Add the frame for vue.
 */
const app = new Vue({
    el: '#app'
});