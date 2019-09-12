<template>
    <nav class="navbar navbar-dark bg-dark">
    <a class="navbar-brand" href="#">User Management App</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
        <router-link to="/login">
            <a class="nav-item nav-link" href="#">Login</a>
        </router-link>
        <router-link to="/view" v-if="userLogedIn">
            <a class="nav-item nav-link" href="#">View|Delete|Update User</a>
        </router-link>
        <router-link to="/signup" v-if="userLogedIn">
             <a class="nav-item nav-link" to="signup" href="#">Signup</a>
        </router-link>
        </div>
    </div>
    </nav>
</template>

<script>
export default {
    computed:{
        userLogedIn: function(){
            const userId = localStorage.getItem("user_id");
            if(userId){
                return true;
            }else{
                return false;
            }
        }
    }
}
</script>

<style>

</style>