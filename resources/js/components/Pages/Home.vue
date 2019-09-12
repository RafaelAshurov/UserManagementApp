<template>
<div class="row text-center mt-3">
    <div class="col-6 text-center">
        <router-link to="/login">
          <button class="btn btn-primary mb-2 big-btn"> Login </button>
        </router-link>
    </div>
    <div class="col-6 text-center">
        <router-link to="/signup">
            <button class="btn btn-success mb-2 big-btn"> Signup </button>
        </router-link>
    </div>
</div>
</template>
<script>
export default {

}
</script>

<style>
.big-btn{
    min-width: 80%;
}
</style>