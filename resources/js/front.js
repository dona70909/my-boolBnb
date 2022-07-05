window.axios = require('axios');
/* window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'; */
Vue.prototype.$userEmail = document.querySelector("meta[name='user-email']").getAttribute('content');


window.Vue = require('vue');

import 'bootstrap/dist/css/bootstrap.min.css'
import 'bootstrap-icons/font/bootstrap-icons.css'


import Vue from 'vue';
import VueRouter from 'vue-router'
import App from './views/App.vue';
Vue.use(VueRouter)
// QUA SOTTO ANDRANNO LE ROTTE DI VUE-ROUTER PER IL FRONT END
import HomePage from "./pages/HomePage";
import AdvancedSearch from "./pages/AdvancedSearch";
import ApartmentDetails from "./pages/ApartmentDetails";
import About from "./pages/About";
import Contact from "./pages/Contact";


const router = new VueRouter({
    mode: 'history', // £ per non avere l'hashtag davanti ad ogni link
    routes: [
        {
            path: '/',
            name: 'home',
            component: HomePage
        },
        //# advenced search page get the input search from apartmentlist page
        {
            path: '/advancedsearch',
            name: 'advancedsearch',
            component: AdvancedSearch,
            props: true,
            meta: {
                KeepAlive: true
            }
        },
        {
            path: '/apartment/:id',
            name: 'apartment-details',
            component: ApartmentDetails
        },
        {
            path: '/about-us',
            name: 'about-us',
            component: About
        },
        {
            path: '/contact-us',
            name: 'contact',
            component: Contact
        },
    ]
});

const app = new Vue({

    router,
    el: '#root',
    render: h => h(App),
    
});
