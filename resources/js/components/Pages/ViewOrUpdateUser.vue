<template>
<div>
    <div 
    class="d-flex justify-content-center loader-div"
    v-if="loader">
        <div class="loader">Loading...</div>
    </div>
        <div class="form-row justify-content-center mt-3" v-if="view">
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
                    {{user.demo_exp_dif}}<br>
                    {{user.demo_exp}}
                </p>
            </div>
            <div class="col-8" v-if="userType == 'live'">
                <p class="m-0">Credit card ending:</p>
                <p class="text-primary">
                    {{user.credit_card}}
                </p>
            </div>
        </div>
        <div class="form-row justify-content-center mt-3" v-if="edit">
            <form @submit.prevent="editUser" class="form-row justify-content-center">
                <div class="col-8 form-group mb-3">
                    <label class="m-0" for="first-name">Edit first Name</label>
                    <input type="text" class="form-control" id="first-name" v-model="form.first_name"> 
                </div>
                <div class="col-8 form-group mb-3">
                    <label class="m-0" for="first-name">Edit last Name</label>
                    <input type="text" class="form-control" id="last-name" v-model="form.last_name"> 
                </div>
                <div class="col-8 form-group mb-3">
                    <label class="m-0" for="email">Edit email</label>
                    <input type="text" class="form-control" id="email" v-model="form.email"> 
                </div>
                <div class="col-8 form-group mb-3">
                    <label class="m-0" for="type">Edit user type</label>
                    <select class="form-control" id="type" v-model="form.type">
                        <option disabled value="">Please select one</option>
                        <option>live</option>
                        <option>demo</option>
                    </select>
                    <span>Selected: {{form.type}}</span>
                </div>
                <div class="col-8 form-group" v-if="form.type == 'demo'">
                    <label>Exparation date</label><br>
                    {{user.demo_exp}}
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
                    <label for="cc">Edit credit card ending:</label>
                    <input type="text" class="form-control" id="cc" v-model="form.credit_card"> 
                </div>
                <div class="col-8 text-center">
                    <button type="submit" class="btn btn-success mb-2"> Update that user </button>
                </div>
            </form>
        </div>
        <div class="form-row justify-content-center mt-3">
            <div class="col-8 text-center">
                <p class="text-danger">
                    {{error}}
                </p>
                <button @click="moveToEdit()" class="btn btn-primary m-2" v-if="view"> Edit User </button>
                <button @click="moveToView()" class="btn btn-primary m-2" v-if="edit"> View User </button>
                <button @click="deleteUser()" class="btn btn-danger m-2"> Delete User </button>
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
                id: '',
                type:'',
                first_name:'',
                last_name:'',
                email:'',
                demo_exp_dif:'',
                demo_exp:'',
                credit_card:'',
            },
            form: {
                id: '',
                type:'',
                first_name:'',
                last_name:'',
                email:'',
                password:'',
                demo_exp_dif:'',
                demo_exp:'',
                demo_exp_day:'',
                demo_exp_month:'',
                demo_exp_year:'',
                credit_card:'',
            },
            userType: '',
            edit: false,
            view: true,
            error:'',
        }
    },
    methods:{
        moveToEdit(){
            this.edit = true;
            this.view = false;
            this.form = JSON.parse(JSON.stringify(this.user));
        },
        moveToView(){
            this.edit = false;
            this.view = true;
            this.form =  {
                type:'',
                first_name:'',
                last_name:'',
                email:'',
                password:'',
                demo_exp_dif:'',
                demo_exp:'',
                demo_exp_day:'',
                demo_exp_month:'',
                demo_exp_year:'',
                credit_card:'',
            };
        },
        editUser(){
            this.loader = true;
            this.form.demo_exp = `${this.form.demo_exp_year}-${this.form.demo_exp_month}-${this.form.demo_exp_day}`;
            axios.post('/api/update', this.form)
            .then(res=> location.reload())
            .catch(error=> {
                this.error = error.response.data.errors;
                this.loader = false;
                });
        },
        deleteUser(){
            this.loader = true;
            axios.delete('/api/user/delete/'+this.user.id, this.form)
            .then(res=> {
                localStorage.removeItem("user_id");
                this.$router.push('/');
                })
            .catch(error=> {
                this.error = error.response.data.errors;
                this.loader = false;
                });
        },
    },
    beforeCreate(){
      let userId = localStorage.getItem("user_id");
      axios.get('/api/user/'+userId)
            .then(res=> {
                this.user = res.data.user;
                this.userType = res.data.user.type; 
                if(this.userType == 'demo'){
                    this.user.demo_exp = this.user.demo_exp.split(' ')[0];
                }
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