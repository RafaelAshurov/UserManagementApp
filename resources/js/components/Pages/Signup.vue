<template>
<div>
    <div 
    class="d-flex justify-content-center loader-div"
    v-if="loader">
        <div class="loader">Loading...</div>
    </div>
        <div class="form-row justify-content-center mt-3">
            <form @submit.prevent="signup" class="form-row justify-content-center">
                <div class="col-8 form-group mb-3">
                    <label class="m-0" for="first-name">First Name:</label>
                    <input type="text" required class="form-control" id="first-name" v-model="form.first_name"> 
                </div>
                <div class="col-8 form-group mb-3">
                    <label class="m-0" for="first-name">Last Name:</label>
                    <input type="text" required class="form-control" id="last-name" v-model="form.last_name"> 
                </div>
                <div class="col-8 form-group mb-3">
                    <label class="m-0" for="email">Email</label>
                    <input type="email" required class="form-control" id="email" v-model="form.email"> 
                </div>
                <div class="col-8 form-group mb-3">
                    <label class="m-0" for="password">Password</label>
                    <input type="password" required class="form-control" id="password" v-model="form.password"> 
                </div>
                <div class="col-8 form-group mb-3">
                    <label class="m-0" for="password-confirmation">Password Confirmation</label>
                    <input type="password" required class="form-control" id="password-confirmation" v-model="form.password_confirmation"> 
                </div>
                <div class="col-8 form-group mb-3">
                    <label class="m-0" for="type">User type</label>
                    <select class="form-control" required id="type" v-model="form.type">
                        <option disabled value="">Please select one</option>
                        <option>live</option>
                        <option>demo</option>
                    </select>
                    <span>Selected: {{form.type}}</span>
                </div>
                <div class="col-8 form-group" v-if="form.type == 'demo'">
                    <label>Exparation date:</label><br>
                    <div class="form-row">
                        <div class="col-2 form-group">
                            <label class="m-0">Year</label>
                            <input minlength="4" type="number" class="form-control" v-model="form.demo_exp_year"> 
                        </div>
                        <div class="col-2 form-group">
                            <label class="m-0">Month</label>
                            <input minlength="2" type="number" class="form-control" v-model="form.demo_exp_month"> 
                        </div>
                        <div class="col-2 form-group">
                            <label class="m-0">Day</label>
                            <input minlength="2" type="number" class="form-control" v-model="form.demo_exp_day">
                        </div>
                    </div>
                </div>
                <div class="col-8 form-group" v-if="form.type == 'live'">
                    <label for="cc">Last 4 digets of your credit card:</label>
                    <input type="text" class="form-control" id="cc" v-model="form.credit_card"> 
                </div>
                <div class="col-8 text-center">
                    <p class="text-danger">{{error}}</p>
                </div>
                <div class="col-8 text-center">
                    <button type="submit" class="btn btn-success mb-2"> Signup </button>
                </div>
            </form>
        </div>
</div>
</template>


<script>

export default {
    data(){
        return{
            loader: false,
            form: {
                id: '',
                type:'',
                first_name:'',
                last_name:'',
                email:'',
                password:'',
                password_confirmation:'',
                demo_exp_dif:'',
                demo_exp:'',
                demo_exp_day:'',
                demo_exp_month:'',
                demo_exp_year:'',
                credit_card:'',
            },
            error:'',
        }
    },
    methods:{
        signup(){
            this.loader = true;
            this.form.demo_exp = `${this.form.demo_exp_year}-${this.form.demo_exp_month}-${this.form.demo_exp_day}`;
            axios.post('/api/signup', this.form)
            .then(res=> {
                localStorage.setItem("user_id", res.data.user.id)
                this.$router.push('view');
                })
            .catch(error=> {
                this.error = error.response.data.errors;
                this.loader = false;
                });
        },
    }
}
</script>

<style>

</style>