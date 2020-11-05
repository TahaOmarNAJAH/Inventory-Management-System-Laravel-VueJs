import Vue from 'vue';
import VueRouter from 'vue-router';
import home from './components/home';
import login from './components/auth/login';
import register from './components/auth/register';
import forget from './components/auth/passwords/forget';


Vue.use(VueRouter);

export default new VueRouter({
    mode: 'history',
    routes: [
        { path: '/', name: '/', component: login },
        { path: '/home', name: 'home', component: home },
        { path: '/register', name: 'register', component: register },
        { path: '/forget', name: 'forget', component: forget },
    ]
});
