import router from './routes';
import User from './Helpers/User';

require('./bootstrap');

window.Vue = require('vue');

window.User = User;

const app = new Vue({
    el: '#app',
    router
});
