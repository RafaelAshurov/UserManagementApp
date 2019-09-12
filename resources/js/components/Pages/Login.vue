<template>
<div>
    <div 
    class="d-flex justify-content-center loader-div"
    v-if="loader">
        <div class="loader">Loading...</div>
    </div>
    <form @submit.prevent="login">
        <div class="form-row justify-content-center mt-3">
            <div class="col-8">
                <label class="sr-only" for="inlineFormInput">Email</label>
                <input class="form-control justify-content-right mb-2"
                 id="inlineFormInput"
                 placeholder="Email"
                 v-model="form.email"
                 type="email"
                 required>
            </div>
            <div class="col-8">
                <label class="sr-only" for="inlineFormInputGroup">Password</label>
                <div class="input-group mb-2">
                   <input class="form-control"
                    id="inlineFormInputGroup"
                    placeholder="Password"
                    v-model="form.password"
                    type="password"
                    required>
                </div>
            </div>
            <div class="col-8 text-danger">
                {{error}}
            </div>
            <div class="col-8 text-center">
                 <button type="submit" class="btn btn-primary mb-2"> Login </button>
            </div>
        </div>
        </form>
</div>
</template>


<script>

export default {
    data(){
        return{
            form:{
                email:null,
                password:null,
            },
            loader: false,
            error: '',
        }
    },
    methods:{
        login(){
            this.loader = true;
            axios.post('/api/login', this.form)
            .then(res=> {
                console.log(res.data);
                localStorage.setItem("user_id", res.data.user.id);
                this.$router.push('view')
                })
            .catch(error=> {
                this.error = error.response.data.message;
                this.loader = false;
                });
        }
    }
}
</script>

<style>

</style>