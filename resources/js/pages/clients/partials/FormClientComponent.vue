<template>
    <div>
        <form class="form" @submit.prevent="onSubmit" enctype="multipart/form-data">
            <div class="form-group mb-3">
                <label for="name" class="form-label">Nome:</label>
                <input type="text" v-model="client.name" class="form-control" id="name" required />
            </div>

            <div class="form-group mb-3">
                <label for="price" class="form-label">Nome Social:</label>
                <input type="text" v-model="client.social_name" class="form-control" id="social_name" required />
            </div>

            <div class="form-group mb-3">
                <label for="price" class="form-label">CPF:</label>
                <input type="text" v-model="client.cpf" class="form-control" id="cpf" maxlength="14"
                    @input="formatCPFInput" required />
            </div>

            <div class="form-group mb-3">
                <label for="description" class="form-label">Data de Nascimento:</label>
                <input type="text" class="form-control" id="birth_date" maxlength="10"
                    @input="formatBirthDateInput" v-model="client.birth_date" placeholder="DD/MM/AAAA" required />
            </div>

            <div class="form-group mb-3">
                <label for="photo" class="form-label">Foto:</label>
                <input type="file" class="form-control" id="photo" @change="handleImageUpload" required />
            </div>

            <input type="hidden" name="_method" value="PUT" />

            <button type="submit" class="btn btn-primary">
                {{ updating ? "Atualizar" : "Enviar" }}
            </button>
        </form>
    </div>
</template>

<script>
import { handleImageUpload, handleErrors } from "../../../helpers/handlers.js";
import { formatCPFInput, formatBirthDateInput } from '../../../helpers/helpers.js';
import { notify } from "@kyvg/vue3-notification";

export default {
    props: {
        client: {
            type: Object,
            default: () => ({
                name: "",
                social_name: "",
                birth_date: "",
                cpf: "",
                image: null,
            }),
        },
        updating: {
            required: false,
            type: Boolean,
            default: false,
        },
    },
    data() {
        return {
            errorMessages: [],
            isSubmitting: false,
        };
    },
    methods: {
        formatCPFInput(event) {
            this.client.cpf = formatCPFInput(event.target.value);
        },
        formatBirthDateInput(event) {
            this.client.birth_date = formatBirthDateInput(event.target.value);
        },
        async onSubmit() {
            try {
                this.isSubmitting = true;
                this.errorMessages = [];

                this.client.cpf = this.client.cpf.replace(/\D/g, '');

                if (this.updating) {
                    await this.createOrUpdateClient(
                        "updateClient",
                        "Cliente atualizado com sucesso",
                        this.$router.push({ name: "clients" })
                    );
                } else {
                    await this.createOrUpdateClient(
                        "storeClient",
                        "Cliente cadastrado com sucesso",
                        this.$router.push({ name: "clients" })
                    );
                }
            } catch (error) {
                this.handleErrors(error);
            } finally {
                this.isSubmitting = false;
            }
        },
        async createOrUpdateClient(action, successMessage) {
            try {
                const formData = new FormData();
                const isUpdate = this.updating;

                formData.append("name", this.client.name);
                formData.append("social_name", this.client.social_name);
                formData.append("cpf", this.client.cpf);
                formData.append("birth_date", this.client.birth_date);
                formData.append("photo", this.client.photo);

                if (this.client.photo !== null) {
                    formData.append("photo", this.client.photo);
                } else {
                    formData.append("photo", null);
                }

                // Campos específicos para atualização
                if (isUpdate) {
                    formData.append("id", this.client.id);
                    formData.append("_method", "PUT");
                }

                // Despache a ação
                await this.$store.dispatch(action, {
                    clientId: this.client.id,
                    data: formData,
                });

                notify({
                    title: "Cliente",
                    text: successMessage,
                    type: "success",
                });
            } catch (error) {
                this.handleErrors(error);
            }
        },
        handleImageUpload(event) {
            handleImageUpload(event, this.client);
        },
        handleErrors(error) {
            handleErrors(error, this.$router);
        },
    }
};
</script>

<style scoped></style>
