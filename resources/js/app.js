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
        meta: { requiresAuth: true }, 
    },
    {
        path: '/register',
        component: Register,
        meta: { requiresGuest: true },
    },
    {
        path: '/login',
        component: Login,
        meta: { requiresGuest: true },
    },
    {
        path: '/form',
        component: Form,
        meta: { requiresAuth: true }, 
    },
    {
        path: '/edit/:id',
        component: Edit,
        meta: { requiresAuth: true }, 
    }    
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    const isAuthenticated = !!localStorage.getItem('token');

    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (!isAuthenticated) {
            next('/login');
        } else {
            next();
        }
    } else if (to.matched.some(record => record.meta.requiresGuest)) {
        if (isAuthenticated) {
            next('/');
        } else {
            next();
        }
    } else {
        next();
    }
});

app.component('nav-bar', Navbar);
app.use(router);

app.mount('#app');
