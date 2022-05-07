<template>
    <div>





  <md-toolbar class="md-primary">
        <h1 class="md-title">Login</h1>
    </md-toolbar>
    
    <md-content>
       <h3 class="text-center">login</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="addProduct">
                  
                    <div class="form-group">
                        <label>email</label>
                        <input type="email" name="email" class="form-control" v-model="user.email">
                    </div>

                    <div class="form-group">
                        <label>password</label>
                        <input type="password" name="password" class="form-control" v-model="user.password">
                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>
    </md-content>


       
    </div>
</template>
 
<script>
import './Login.css'
    export default {
        data() {
            return {
                user: {}
            }
        },
        methods: {
            addProduct() {
                this.axios
                    .post('http://localhost:8000/api/login', this.user)
                    .then(response => {
                        console.table(response)
                        localStorage.setItem("token",response.data.authorisation.token);

                        this.$router.push({ name: 'me' })
                    })
                    .catch(err => console.log(err))
                    .finally(() => this.loading = false)
            }
        }
    }
</script>