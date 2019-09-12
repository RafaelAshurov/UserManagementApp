import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import Login from '../components/Pages/Login.vue';
import ViewOrUpdateUser from '../components/Pages/ViewOrUpdateUser.vue';
import EditUser from '../components/Pages/EditUser.vue';
import Signup from '../components/Pages/Signup.vue';
import Home from '../components/Pages/Home.vue';

const routes = [
    { path: '/', component: Home},
    { path: '/login', component: Login, name:'login' },
    { path: '/signup', component: Signup, name:'signup' },
    { path: '/view', component: ViewOrUpdateUser, name:'view' },
  ];

  const router = new VueRouter({
    routes,
    mode : 'history'
  })

  export default router