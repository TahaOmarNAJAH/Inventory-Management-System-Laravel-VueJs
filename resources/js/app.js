import router from './routes';
import User from './Helpers/User';
import Swal from 'sweetalert2';
import Notification from './Helpers/Notification';
import TopBar from './components/topbar';
require('./bootstrap');

window.Vue = require('vue');

window.User = User;

window.Notification = Notification;


//sweet alert
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
});

window.Toast = Toast;
//end sweet alert  
window.Reload = new Vue();

const app = new Vue({
    el: '#app',
    components: {
        TopBar
    },
    router
});
