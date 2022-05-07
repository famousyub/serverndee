<template>
    <div>


         <md-toolbar class="md-primary">
        <h1 class="md-title">Signup</h1>
    </md-toolbar>
    
    <md-content>
         <h3 class="text-center">Register</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="addProduct">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="user.name">
                    </div>
                    <div class="form-group">
                        <label>email</label>
                        <input type="email" class="form-control" v-model="user.email">
                    </div>

                    <div class="form-group">
                        <label>password</label>
                        <input type="password" class="form-control" v-model="user.password">
                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>
    </md-content>
       
    </div>
</template>
 
<script>
import './Register.css'
    export default {
        data() {
            return {
                user: {}
            }
        },
        methods: {
            addProduct() {
                this.axios
                    .post('http://localhost:8000/api/register', this.user)
                    .then(response => (
                        console.table(response)
                       // this.$router.push({ name: 'home' })s
                    ))
                    .catch(err => console.log(err))
                    .finally(() => this.loading = false)
            }
        }
    }
</script>