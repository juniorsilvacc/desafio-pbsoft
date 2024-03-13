import { createApp } from "vue";

import Notifications from '@kyvg/vue3-notification'
import App from "./App.vue";
import router from "./router";
import store from './store';

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap/dist/js/bootstrap.bundle'

createApp(App)
    .use(router)
    .use(store)
    .use(Notifications)
    .mount("#app");
