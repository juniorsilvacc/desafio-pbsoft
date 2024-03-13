<template>
    <div class="container">
        <h1 class="title">Adicionar Novo Cliente</h1>

        <FormClientComponent :client="client" />
    </div>
</template>

<script>
import FormClientComponent from "./partials/FormClientComponent.vue";

export default {
    components: {
        FormClientComponent,
    },
    data() {
        return {
            client: {
                name: "",
                social_name: "",
                birth_date: "",
                cpf: "",
                photo: new FormData()
            }
        };
    }
};
</script>

<style scoped>
</style>
