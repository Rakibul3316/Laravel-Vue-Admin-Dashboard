require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';
Vue.use(VueRouter);

// Router Imported
import { routes } from './routes';

// Import Notification Class
import Notification from './components/helpers/Notification';
window.Notification = Notification;

window.Reload = new Vue();


// Import User Class
// import User from './components/helpers/User';
// window.user = User;

// Sweet Alert Start

import Swal from 'sweetalert2';
window.Swal = Swal;

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})

window.Toast = Toast;

const router = new VueRouter({
    routes, // short for `routes: routes`
    mode: 'history',
})


const app = new Vue({
    el: '#app',
    router
});










// import { routes } from './routes';

// routes = [
//     { path: '/', component: Home },
//     { path: '/login', component: Login },
// ]

// const router = new VueRouter({
//     routes, // short for `routes: routes`
//     mode: 'history'
// })

// // Vue.component('example-component', require('./components/ExampleComponent.vue').default);


// const app = new Vue({
//     el: '#app',
//     router
// });


