<template>
    <div class="preloader" v-show="preloader">
        <div class="spinner"></div>
    </div>
</template>

<script>
export default {
    computed: {
        preloader() {
            return this.$store.state.preloader.loading
        }
    }
}
</script>

<style scope>
.preloader {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(197, 197, 197, 0.8);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
}

.spinner {
    border: 5px solid #a7a7a7;
    border-top: 5px solid #ffffff;
    border-radius: 50%;
    width: 100px;
    height: 100px;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% {
        transform: rotate(0deg);
    }

    100% {
        transform: rotate(360deg);
    }
}
</style>
