import './bootstrap';
import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';

const app = createApp({});

import Navbar from './components/shared/Navbar.vue';

import Register from './components/auth/Register.vue';
import Login from './components/auth/Login.vue';

import Form from './components/tasks/Form.vue';
import Tasks from './components/tasks/Lists.vue';
import Edit from './components/tasks/Edit.vue';

const routes = [
    {
        path: '/',
        component: Tasks,
    },
    {
        path: '/register',
        component: Register,
    },
    {
        path: '/login',
        component: Login,
    },
    {
        path: '/form',
        component: Form,
    },
    {
        path: '/edit/:id',
        component: Edit
    }    
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});
app.component('nav-bar', Navbar);
app.use(router);

app.mount('#app');
