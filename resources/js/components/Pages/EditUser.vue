<template>
<div>
    <div 
    class="d-flex justify-content-center loader-div"
    v-if="loader">
        <div class="loader">Loading...</div>
    </div>
        <div class="form-row justify-content-center mt-3">
            <div class="col-8">
                <p class="m-0">User Type:</p>
                <p class="text-primary">
                    {{user.type}}
                </p>
            </div>
            <div class="col-8">
                <p class="m-0">First Name:</p>
                <p class="text-primary">
                    {{user.first_name}}
                </p>
            </div>
            <div class="col-8">
                <p class="m-0">Last Name:</p>
                <p class="text-primary">
                    {{user.last_name}}
                </p>
            </div>
            <div class="col-8">
                <p class="m-0">Email:</p>
                <p class="text-primary">
                    {{user.email}}
                </p>
            </div>
            <div class="col-8" v-if="userType == 'demo'">
                <p class="m-0">Exparation date:</p>
                <p class="text-primary">
                    {{user.demo_exp_dif}}
                    {{user.demo_exp}}<br>
                </p>
            </div>
            <div class="col-8" v-if="userType == 'live'">
                <p class="m-0">Credit card ending:</p>
                <p class="text-primary">
                    {{user.credit_card}}
                </p>
            </div>
            <div class="col-8 text-center">
                <router-link to="login">
                    <button class="btn btn-primary m-2"> Edit User </button>
                </router-link>
                <router-link to="login">
                    <button class="btn btn-danger m-2"> Delete User </button>
                </router-link>
            </div>
        </div>
</div>
</template>


<script>

export default {
    data(){
        return{
            loader: true,
            user: {
                type:'',
                first_name:'',
                last_name:'',
                email:'',
                demo_exp_dif:'',
                demo_exp:'',
                credit_card:'',
            },
            userType: '',
        }
    },
    methods:{

    },
    beforeCreate(){
      let userId = localStorage.getItem("user_id");
      axios.get('/api/user/'+userId)
            .then(res=> {
                this.user = res.data.user;
                this.userType = res.data.user.type; 
                this.loader = false;
                })
            .catch(error=> {
                console.log(error);
            });
    }
}
</script>

<style>

</style>