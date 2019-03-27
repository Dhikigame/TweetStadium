
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
// import router from './router'
window.Vue = require('vue');
import VueRouter from 'vue-router';
import Home from './components/HomeComponent.vue';
import Foo from './components/FooComponent.vue';
import Bar from './components/BarComponent.vue';

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue'));

// home = Vue.component('home-component', require('./components/HomeComponent.vue').default);
// foo = Vue.component('foo-component', require('./components/FooComponent.vue').default);
// bar = Vue.component('bar-component', require('./components/BarComponent.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
// Vue.component('hello-world-component', require('./components/HelloWorldComponent.vue'));
  
Vue.use(VueRouter)

// Components
// const Home = { template: home }
// const Foo  = { template: foo };
// const Bar  = { template: bar };

// Router
const routes = [
    { path: '/stadium/:id/index', name: 'stadium', component: Home},
    { path: '/stadium/:id/game', name: 'game', component: Foo },
    { path: '/stadium/:id/comment', name: 'comment', component: Bar },
];

const router = new VueRouter({
    mode: 'history',
    routes
});

const app = new Vue({
    // el: '#app',
    // data: {
    //     stadium: {}
    // },
    // mounted() {
    //     var self = this;
    //     var url = '/ajax/stadium';
    //     axios.get(url).then(function(response){
    //         self.stadium = response.data;
    //         console.log(self.stadium);
    //     });
    // },
    router
}).$mount('#app');

// methods: {
//     changeRouter () {
//       this.$router.push({
//         name: 'HogePage',
//         params: {
//           category: 'category_name',
//           post_id: 123
//         }
//       })
//     };
//   }

    // { path: '/',    component: require('./components/HomeComponent.vue') },
    // { path: '/foo', component: require('./components/FooComponent.vue') },
    // { path: '/bar', component: require('./components/BarComponent.vue') },