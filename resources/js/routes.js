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

import Stock from './components/products/stock/index';
import EditStock from './components/products/stock/edit';



import Expenses from './components/expenses/index';
import CreateExpense from './components/expenses/create';
import EditExpense from './components/expenses/edit';

import Salary from './components/salaries/all_employee';
import PaySalary from './components/salaries/create';
import Salaries from './components/salaries/index';
import EditSalary from './components/salaries/edit';
import ViewSalary from './components/salaries/view';


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
        // Expenses routes
        { path: '/expenses/index', name: 'all-expenses', component: Expenses },
        { path: '/expenses/create', name: 'create-expense', component: CreateExpense },
        { path: '/expenses/edit/:id', name: 'edit-expense', component: EditExpense },
        // Sallaries routes
        { path: '/given-salary', name: 'given-salary', component: Salary },
        { path: '/pay-salary/:id', name: 'pay-salary', component: PaySalary },
        
        { path: '/salaries/index', name: 'all-salaries', component: Salaries },
        { path: '/salaries/show/:id', name: 'view-salary', component: ViewSalary },
        { path: '/salaries/edit/:id', name: 'edit-salary', component: EditSalary },
        
        { path: '/stock/index', name: 'stock', component: Stock },
        { path: '/stock/edit/:id', name: 'edit-stock', component: EditStock },

        
    ]
});
