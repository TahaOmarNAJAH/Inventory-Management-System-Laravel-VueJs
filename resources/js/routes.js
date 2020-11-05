import Vue from 'vue';
import VueRouter from 'vue-router';

import home from './components/home';

import login from './components/auth/login';
import register from './components/auth/register';
import logout from './components/auth/logout';
import forget from './components/auth/passwords/forget';

import CreateEmployee from './components/employees/create';
import Employees from './components/employees/index';


Vue.use(VueRouter);

export default new VueRouter({
    mode: 'history',
    routes: [
        { path: '/', name: '/', component: login },
        { path: '/home', name: 'home', component: home },
        { path: '/register', name: 'register', component: register },
        { path: '/logout', name: 'logout', component: logout },
        { path: '/forget', name: 'forget', component: forget },
        { path: '/employees/index', name: 'all-employees', component: Employees },
        { path: '/employees/create', name: 'create-employee', component: CreateEmployee },
    ]
});
