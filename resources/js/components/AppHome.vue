<template>
<div class="container-fluid p-0">
    <nav-bar></nav-bar>
    <router-view></router-view>
</div>
</template>

<script>
import NavBar from './NavBar.vue';

export default {
    components:{
        NavBar
    }
}
</script>

<style>

</style>