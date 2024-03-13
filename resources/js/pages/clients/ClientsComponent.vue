<template>
    <div class="container" v-if="clients && clients.meta">
        <h1 class="title">Clientes</h1>

        <div class="card-title mb-4 px-0">
            <div class="d-flex justify-content-between align-items-center">
                <SearchClientComponent @searchClient="search" />

                <router-link :to="{ name: 'clients.create' }" class="btn btn-success btn-add">
                    <i class="mdi mdi-plus"></i> Adicionar
                </router-link>
            </div>
        </div>

        <div class="table-container">
            <table class="table table-striped table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Nome Social</th>
                        <th>CPF</th>
                        <th>Data de Nascimento</th>
                        <th width="130">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(client, index) in clients.data" :key="index">
                        <td>{{ client.name }}</td>
                        <td>{{ client.social_name }}</td>
                        <td>{{ formatCPF(client.cpf) }}</td>
                        <td>{{ formatBirthDate(client.birth_date) }}</td>
                        <td>
                            <router-link :to="{ name: 'clients.detail', params: { id: client.id } }"
                                class="btn btn-primary btn-acction btn-sm">
                                <i class="fas fa-eye"></i>
                            </router-link>
                            <router-link :to="{ name: 'clients.edit', params: { id: client.id } }"
                                class="btn btn-warning btn-acction btn-sm">
                                <i class="fas fa-edit"></i>
                            </router-link>
                            <a class="btn btn-danger btn-sm" type="button" @click.prevent="confirmDestroy(client)">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Paginate -->
        <PaginationComponent :currentPage="currentPage" :lastPage="clients.meta.last_page" :changePage="paginate" />
    </div>
</template>

<script>
import { notify } from "@kyvg/vue3-notification";
import { formatCPF, formatBirthDate } from '../../helpers/helpers.js';
import SearchClientComponent from "../../components/SearchProductComponent.vue";
import PaginationComponent from "../../components/PaginationComponent.vue";

export default {
    name: "ClientsComponent",

    components: {
        SearchClientComponent,
        PaginationComponent,
    },
    data() {
        return {
            name: '',
            currentPage: 1,
        };
    },
    created() {
        this.$store.dispatch("loadClients", { name: this.name });
    },
    computed: {
        clients() {
            return this.$store.state.clients.items;
        },
    },
    methods: {
        confirmDestroy(client) {
            if (
                window.confirm(
                    `Tem certeza de que deseja excluir: ${client.name}?`
                )
            ) {
                this.destroy(client);
            }
        },
        destroy(client) {
            this.$store
                .dispatch("destroyClient", client.id)
                .then(() => {
                    notify({
                        title: `${client.name} foi deletado!`,
                        type: "success",
                    });
                })
                .catch((error) => {
                    notify({
                        title: "Error ao deletar cliente",
                        type: "error",
                    });
                });
        },
        search(filter) {
            this.$store.dispatch("loadClients", { name: filter, page: 1 });
        },
        paginate(page) {
            this.currentPage = page;
            this.$store.dispatch("loadClients", { name: this.name, page });
        },

        // Formatting methods
        formatCPF, formatBirthDate,
    },
};
</script>

<style scoped>
.acctions {
    display: flex;
    align-items: center;
}

.btn-acction {
    margin-right: 6px;
}

@media (max-width: 767px) {
    .table-container {
        overflow-x: auto;
        white-space: nowrap;
    }
    .table {
        font-size: 14px;
    }
    .btn-add {
        font-size: 14px;
    }
}
</style>
