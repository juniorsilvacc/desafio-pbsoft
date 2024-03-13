<template>
    <div>
        <form
            class="form form-inline input-group"
            @submit.prevent="search"
        >
            <input type="text" v-model="filter" class="form-control input" placeholder="Search..." />
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" @click="handleSearch">
                    Pesquisar
                </button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    data () {
        return {
            filter: ''
        }
    },
    methods: {
        search() {
            this.$emit('searchClient', this.filter);
        },
    },
};
</script>

<style scoped>
@media (max-width: 767px) {
    .input {
        font-size: 14px;
    }
    .btn {
        font-size: 14px !important;
    }
}
</style>
