<template>
    <div class="container">
        <h1 class="title">Clientes</h1>

        <div class="card-title mb-4 px-0">
            <div class="d-flex justify-content-between align-items-center">
                <div class="search">
                    <input type="text" class="form-control" placeholder="Pesquisar" />
                </div>

                <a href="#" class="btn btn-success">
                    <i class="mdi mdi-plus"></i> Adicionar
                </a>
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
                    <td>{{ client.data_nascimento }}</td>
                    <td>{{ client.cpf }}</td>
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
    </div>
</template>

<script>
export default {
    name: "ClientsComponent",
    data() {
        return {
        };
    },
    created() {
        this.$store.dispatch("loadClients");
    },
    computed: {
        clients() {
            return this.$store.state.clients.items;
        },
    },
    methods: {
    },
};
</script>

<style scoped>
.title {
    margin: 20px 0 30px 0;
    font-weight: 600;
}

.search {
    width: 50%;
}

.acctions {
    display: flex;
    align-items: center;
}

.btn-acction {
    margin-right: 6px;
}
</style>
