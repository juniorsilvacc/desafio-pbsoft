import { createRouter, createWebHistory } from "vue-router";

import ClientsComponent from '../pages/clients/ClientsComponent.vue';
import ClientAddComponent from '../pages/clients/ClientAddComponent.vue';
import ClientDetailComponent from '../pages/clients/ClientsComponent.vue';
import ClientEditComponent from '../pages/clients/ClientsComponent.vue';

const routes = [
    {
        path: '/',
        name: 'clients',
        component: ClientsComponent
    },
    {
        path: '/cadastrar',
        name: 'clients.create',
        component: ClientAddComponent
    },
    {
        path: '/detalhes/:id',
        name: 'clients.detail',
        component: ClientDetailComponent
    },
    {
        path: '/editar/:id',
        name: 'clients.edit',
        component: ClientEditComponent
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
