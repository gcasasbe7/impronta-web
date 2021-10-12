window.onload = function () {

    // Vue.component('products', require('./components/Products.vue'));

    Vue.component('products', {
        template: '<h1>Template Example</h1>'
    });

    new Vue({
        el: '#app'
    });
};

