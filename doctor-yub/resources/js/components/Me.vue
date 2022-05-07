<template>
    <div>

           <md-toolbar class="md-primary">
        <h1 class="md-title">Me   {{user.name}}</h1>
    </md-toolbar>
    
    <md-content>
        <h1>
            {{user.id}}
            {{user.email}}
        </h1>

        <button @click="logout()">logout</button>
    </md-content>
  </div>

</template>


<script>


export default  {


    data() {
            return {
                user: {}
            }
        },
        methods: {
            logout(){
                 const token = localStorage.getItem('token')
                 if(localStorage.getItem('token')){

                            this.axios.post('http://localhost:8000/api/logout',null,{ headers: {"Authorization" : `Bearer ${token}`}}).then(res=>{
                    localStorage.removeItem('token');
                       this.$router.push({ name: 'home' })  
                       
                })
                 }
               

            },
            addProduct() {
                const token = localStorage.getItem('token')
                this.axios
                    .get('http://localhost:8000/api/me',{ headers: {"Authorization" : `Bearer ${token}`}} )
                    .then(response => {
                        console.table(response)
                        this.user = response.data.user;
                        //localStorage.setItem("token",response.data.authorisation.token);

                        //this.$router.push({ name: 'home' })
                    })
                    .catch(err => console.log(err))
                    .finally(() => this.loading = false)
            }
        },
        mounted(){
            this.addProduct();
        }

}
</script>
