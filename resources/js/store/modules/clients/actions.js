import axios from "axios";

import { URL_BASE } from "../../../config/configurations";
const RESOURCE = "clients";

export default {
    async loadClients(context, params) {
        context.commit('CHANGE_PRELOADER', true);
        try {
            const response = await axios.get(`${URL_BASE}${RESOURCE}`, {
                params,
            });
            context.commit('CHANGE_PRELOADER', false);
            context.commit("LOAD_CLIENTS", response.data);
        } catch (error) {
            context.commit('CHANGE_PRELOADER', false);
            throw error;
        }
    },
};
