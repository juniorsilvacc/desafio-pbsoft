<template>
    <div class="pagination">
        <nav aria-label="Navegação de página">
            <ul class="pagination">
                <li class="page-item" :class="{ disabled: currentPage === 1 }">
                    <a
                        class="page-link"
                        @click="changePage(currentPage - 1)"
                        href="#"
                        aria-label="Anterior"
                    >
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <li>
                    <span class="page-link" v-if="currentPage">{{ currentPage }}</span>
                </li>
                <li
                    class="page-item"
                    :class="{ disabled: currentPage === lastPage }"
                >
                    <a
                        class="page-link"
                        @click="changePage(currentPage + 1)"
                        href="#"
                        aria-label="Próxima"
                    >
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</template>

<script>
export default {
    props: {
        currentPage: {
            type: Number,
            required: true,
        },
        lastPage: {
            type: Number,
            required: true,
        },
        changePage: {
            type: Function,
            required: true,
        },
    },
    methods: {
        paginate(page) {
            // Verifica se o número da página está fora dos limites válidos, Retorna se for válido
            if (page < 1 || page > this.lastPage) {
                return;
            }
            // Dispara a ação para atualizar a página
            this.changePage(page);
        },
    },
};
</script>

<style scoped></style>
