import axios from "axios";

import { URL_BASE } from "../../../config/configurations";
const RESOURCE = "clients";

export default {
    async loadClients(context, params) {
        context.commit("CHANGE_PRELOADER", true);
        try {
            const response = await axios.get(`${URL_BASE}${RESOURCE}`, {
                params,
            });
            context.commit("CHANGE_PRELOADER", false);
            context.commit("LOAD_CLIENTS", response.data);
        } catch (error) {
            context.commit("CHANGE_PRELOADER", false);
            throw error;
        }
    },
    async loadClient(context, id) {
        context.commit("CHANGE_PRELOADER", true);

        try {
            const response = await axios.get(`${URL_BASE}${RESOURCE}/${id}`);
            context.commit("CHANGE_PRELOADER", false);
            return response.data;
        } catch (error) {
            context.commit("CHANGE_PRELOADER", false);
            throw error;
        }
    },
    async storeClient(context, params) {
        context.commit("CHANGE_PRELOADER", true);

        try {
            const response = await axios.post(
                `${URL_BASE}${RESOURCE}`,
                params.data
            );
            context.commit("CHANGE_PRELOADER", false);
            context.dispatch("loadClients");
            return response.data;
        } catch (error) {
            context.commit("CHANGE_PRELOADER", false);
            throw error;
        }
    },
    async updateClient(context, params) {
        context.commit("CHANGE_PRELOADER", true);

        try {
            const response = await axios.post(
                `${URL_BASE}${RESOURCE}/${params.clientId}`,
                params.data,
                {
                    headers: {
                        "X-HTTP-Method-Override": "PUT",
                    },
                }
            );
            context.commit("CHANGE_PRELOADER", false);
            return response.data;
        } catch (error) {
            context.commit("CHANGE_PRELOADER", false);
            throw error;
        }
    },
    async destroyClient(context, clientId) {
        context.commit("CHANGE_PRELOADER", true);

        try {
            const response = await axios.delete(
                `${URL_BASE}${RESOURCE}/${clientId}`
            );
            context.commit("CHANGE_PRELOADER", false);
            context.dispatch("loadClients");
            return response.data;
        } catch (error) {
            context.commit("CHANGE_PRELOADER", false);
            throw error;
        }
    },
};
