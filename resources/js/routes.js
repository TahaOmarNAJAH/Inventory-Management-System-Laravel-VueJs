import Vue from 'vue';
import VueRouter from 'vue-router';

import home from './components/home';

import login from './components/auth/login';
import register from './components/auth/register';
import logout from './components/auth/logout';
import forget from './components/auth/passwords/forget';

import Employees from './components/employees/index';
import CreateEmployee from './components/employees/create';
import EditEmployee from './components/employees/edit';

import Suppliers from './components/suppliers/index';
import CreateSupplier from './components/suppliers/create';
import EditSupplier from './components/suppliers/edit';

import Categories from './components/categories/index';
import CreateCategory from './components/categories/create';
import EditCategory from './components/categories/edit';

import Products from './components/products/index';
import CreateProduct from './components/products/create';
import EditProduct from './components/products/edit';


Vue.use(VueRouter);

export default new VueRouter({
    mode: 'history',
    routes: [
        { path: '/home', name: 'home', component: home },
        // Auth routes
        { path: '/', name: '/', component: login },
        { path: '/register', name: 'register', component: register },
        { path: '/logout', name: 'logout', component: logout },
        { path: '/forget', name: 'forget', component: forget },
        // Employees routes
        { path: '/employees/index', name: 'all-employees', component: Employees },
        { path: '/employees/create', name: 'create-employee', component: CreateEmployee },
        { path: '/employees/edit/:id', name: 'edit-employee', component: EditEmployee },
        // Suppliers routes
        { path: '/suppliers/index', name: 'all-suppliers', component: Suppliers },
        { path: '/suppliers/create', name: 'create-supplier', component: CreateSupplier },
        { path: '/suppliers/edit/:id', name: 'edit-supplier', component: EditSupplier },
        // Categories routes
        { path: '/categories/index', name: 'all-categories', component: Categories },
        { path: '/categories/create', name: 'create-category', component: CreateCategory },
        { path: '/categories/edit/:id', name: 'edit-category', component: EditCategory },
        // Products routes
        { path: '/products/index', name: 'all-products', component: Products },
        { path: '/products/create', name: 'create-product', component: CreateProduct },
        { path: '/products/edit/:id', name: 'edit-product', component: EditProduct },
    ]
});
