<template>
    <div class="container">
        <h1>Editar Cliente</h1>

        <FormClientComponent :client="client.data" :updating="true" />
    </div>
</template>

<script>
import { useStore } from "vuex";
import FormClientComponent from "./partials/FormClientComponent.vue";
import { formatBirthDate } from "../../helpers/helpers.js";

export default {
    props: {
        id: {
            required: true,
        },
    },
    components: {
        FormClientComponent,
    },
    data() {
        return {
            client: {
                data: {
                    name: "",
                    social_name: "",
                    birth_date: "",
                    cpf: "",
                    image: null,
                },
            },
        };
    },
    created() {
        const store = useStore();

        store
            .dispatch("loadClient", this.id)
            .then((response) => {
                response.data.birth_date = formatBirthDate(response.data.birth_date);
                this.client.data = response.data;
            })
            .catch((error) => {
                console.log(error);
            });
    },
};
</script>
