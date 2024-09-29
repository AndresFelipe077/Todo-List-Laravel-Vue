import './bootstrap';
import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';

const app = createApp({});

import Form from './components/tasks/Form.vue';
import Tasks from './components/tasks/Lists.vue';

const routes = [
    {
        path: '/',
        component: Tasks,
    },
    {
        path: '/form',
        component: Form,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

app.use(router);

app.mount('#app');
