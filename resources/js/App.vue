<template>
    <notifications />
    <router-view></router-view>
    <preloader />
</template>

<script>
import preloader from "./components/PreLoaderComponent.vue";

export default {
    components: {
        preloader,
    },
    name: 'App'
}
</script>

<style>
@import url("https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap");
@import url("https://pro.fontawesome.com/releases/v5.10.0/css/all.css");

.vue-notification {
    margin-top: 20px;
}

.title {
    margin: 20px 0 30px 0;
    font-weight: 600;
}
</style>
