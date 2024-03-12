<template>
    <div class="container" v-if="clients && clients.meta">
        <h1 class="title">Clientes</h1>

        <div class="card-title mb-4 px-0">
            <div class="d-flex justify-content-between align-items-center">
                <SearchClientComponent @searchClient="search" />

                <router-link :to="{ name: 'clients.create' }" class="btn btn-success">
                    <i class="mdi mdi-plus"></i> Adicionar
                </router-link>
            </div>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Nome Social</th>
                    <th>Data de Nascimento</th>
                    <th>CPF</th>
                    <th width="160">Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(client, index) in clients.data" :key="index">
                    <td>{{ client.nome }}</td>
                    <td>{{ client.nome_social }}</td>
                    <td>{{ formatBirthDate(client.data_nascimento) }}</td>
                    <td>{{ formatCPF(client.cpf) }}</td>
                    <td>
                        <a class="btn btn-primary btn-acction">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a class="btn btn-warning btn-acction">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a class="btn btn-danger">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Paginate -->
        <PaginationComponent :currentPage="currentPage" :lastPage="clients.meta.last_page" :changePage="paginate" />
    </div>
</template>

<script>
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
</style>
