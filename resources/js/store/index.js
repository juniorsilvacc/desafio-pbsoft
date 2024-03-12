import { createStore } from "vuex";

import Clients from "./modules/clients";
import Preloader from "./modules/preloader";

const store = createStore({
    modules: {
        clients: Clients,
        preloader: Preloader
    },
});

export default store;
