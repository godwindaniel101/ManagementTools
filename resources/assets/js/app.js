
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import moment from 'moment'
import Vue from 'vue'
import VueRouter from 'vue-router'
import VueProgressBar from 'vue-progressbar'
import { Form, HasError, AlertError } from 'vform'
import Swal from 'sweetalert2'
import VueChatScroll from 'vue-chat-scroll'
import { Vuetable, VuetablePagination } from 'vuetable-2'
import Select2 from 'v-select2-component';
 
Vue.component('Select2', Select2);
Vue.component('vuetable', Vuetable)
Vue.component('vuetable-pagination', VuetablePagination)

Vue.use(VueRouter)
Vue.use(VueProgressBar, options)
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
Vue.use(Vuetable)
Vue.use(VueChatScroll)

//
let Trigger = new Vue;
const options = {
  color: '#bffaf3',
  failedColor: 'red',
  thickness: '5px',
  transition: {
    speed: '0.2s',
    opacity: '0.6s',
    termination: 300
  },
  autoRevert: true,
  location: 'left',
  inverse: false
}

const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  onOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

window.Toast = Toast
window.Vue = require('vue');
window.Form = Form
window.Swal = require('sweetalert2')
window.Trigger = Trigger

//vue filter
Vue.filter('textTransform', function(value){
  if (!value) return ''
  value = value.toString()
  return value.charAt(0).toUpperCase() + value.slice(1)
});
Vue.filter('Capitalize', function(value){
  if (!value) return ''
  value = value.toString()
  return value.toUpperCase()
});
Vue.filter('dateChange', function(value){
  return moment(value).format('MMMM Do YYYY');
});
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example-component', redquire('./components/Profile.vue'));

Vue.component(
  'passport-clients',
  require('./components/passport/Clients.vue')
);

Vue.component(
  'passport-authorized-clients',
  require('./components/passport/AuthorizedClients.vue')
);

Vue.component(
  'passport-personal-access-tokens',
  require('./components/passport/PersonalAccessTokens.vue')
);
Vue.component('todo-item', {
  props: ['todo'],
  template: '<li>{{ todo.text }}</li>'
})
const routes = [
    { path: '/dashboard', component: require('./components/Dashboard.vue') },
    { path: '/home', component: require('./components/Dashboard.vue') },
    { path: '/profile', component: require('./components/Profile.vue') },
    { path: '/chat', component: require('./components/Chat.vue') },
    { path: '/calendar', component: require('./components/Calendar.vue') },
    { path: '/to-do', component: require('./components/Todo.vue') },
    { path: '/calculator', component: require('./components/Calculator.vue') },
    { path: '/notebook', component: require('./components/Notebook.vue') },
    { path: '/phonebook', component: require('./components/Phonebook.vue') },
    { path: '/setting', component: require('./components/Setting.vue') },
    { path: '/task', component: require('./components/Task.vue') },
    { path: '/users', component: require('./components/User.vue') },
    { path: '/developer', component: require('./components/Developer.vue') },
    { path: '/view/:id', component: require('./components/View.vue') },
    { path: '/make-sales', component: require('./components/MakeSales.vue') },
    { path: '/view-sales', component: require('./components/ViewSales.vue') },
    { path: '/today-sales', component: require('./components/TodaySales.vue') },
    { path: '/create-product', component: require('./components/CreateProduct.vue') },
  ]
const router = new VueRouter({
  mode : "history",
  routes})
const app = new Vue({
    el: '#app',
    router
});
