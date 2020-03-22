<template>
    <div class="container">
        <router-link to="/users"><i class="fas fa-long-arrow-alt-left"></i></router-link>
        <div class="row justify-content-center">
    
            <div class="col-md-4">
               <div class="card card-primary card-outline">
              <div class="card-body box-profile" >
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle" :src="'/image/icon.png'" alt="User profile picture">
                </div>

                <h3 class="profile-username text-center" >{{data.name}}</h3>

                <p class="text-muted text-center">{{data.position}}</p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Email</b> <a class="float-right">{{data.email}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>ACL</b> <a class="float-right">{{data.type | textTransform}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Date Joined</b> <a class="float-right">{{data.created_at | dateChange}}</a>
                  </li>
                </ul>

               
              </div>
              <!-- /.card-body -->
            </div>

            
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                id : '',
                data : {}
            }
        },
        methods:{
            getid(){this.id = parseInt(this.$route.params.id)},
             loadUser(){
             axios.get('/api/user/' + this.id)
             .then(({ data }) => { this.data = data});
            },
        },
        mounted() {
            this.getid()
            console.log('Component mounted.')
            this.loadUser()
        }
    }
</script>


