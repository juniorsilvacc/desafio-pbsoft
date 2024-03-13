<template>
    <div class="container">
        <h1 class="my-4">Detalhes do Cliente</h1>

        <div class="row">
            <div class="col-md-8">
                <ul class="list-group">
                    <li class="list-group-item"><strong>Nome:</strong> {{ client.data.name }}</li>
                    <li class="list-group-item"><strong>Nome Social:</strong> {{ client.data.social_name }}</li>
                    <li class="list-group-item"><strong>CPF:</strong> {{ formatCPF(client.data.cpf) }}</li>
                    <li class="list-group-item"><strong>Data de Nascimento:</strong> {{
                        formatBirthDate(client.data.birth_date) }}
                    </li>
                </ul>
            </div>
            <div class="col-md-4">
                <div class="client-image-container">
                    <img :src="clientImage" alt="Imagem do Cliente" class="img-fluid client-image">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { useStore } from 'vuex';
import { formatCPF, formatBirthDate } from '../../helpers/helpers.js';

export default {
    props: {
        id: {
            required: true,
        },
    },
    data() {
        return {
            client: {
                data: {
                    name: "",
                    social_name: "",
                    cpf: "",
                    birth_date: "",
                    photo: "",
                },
            }
        }
    },
    created() {
        const store = useStore();

        store.dispatch("loadClient", this.id)
            .then((response) => {
                this.client = response;
            })
            .catch((error) => {
                console.log(error);
            });
    },
    computed: {
        clientImage() {
            return this.client.data.photo ? `/storage/clients/${this.client.data.photo}` : '/img/default.jpg';
        }
    },
    methods: {
        // Formatting methods
        formatCPF, formatBirthDate,
    }
}
</script>

<style scoped>
.client-image-container {
    width: 250px;
    margin: 0 auto;
    border: 1px solid #c7c3c3;
}

.client-image {
    width: 100%;
    height: auto;
}

.list-group-item:first-child {
    font-size: 1.2em;
}

.col-md-6:last-child {
    margin-top: 20px;
}
</style>
