<template>
    <div class="container">
      
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
              <div class="card-header">
                <h3 class="card-title">Employee List</h3>

                <div class="card-tools">
                 <button class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-user-plus"></i></button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Position</th>
                      <th>Status</th>
                      <th>Date Joined</th>
                      <th>Modify</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(user,index) in users" :key="user.id">
                      <td>{{index + 1}}</td>
                      <td>{{user.name | textTransform}}</td>
                      <td>{{user.email}}</td>
                      <td>{{user.position ? user.position : '-' | textTransform}}</td>
                      <td>{{user.type ? user.type : '-' | Capitalize}}</td>
                      <td>{{user.created_at | dateChange}}</td>
                      <td>
                          <div class="dropdown show">
                            <a class="btn btn-outline-success dropdown-toggle" href="#" role="button" id="dropdownMenuLink" 
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Action
                            </a>
                            <div class="dropdown-menu " aria-labelledby="dropdownMenuLink">
                              <router-link :to="'/view/' + user.id"  class="dropdown-item" href="#"><i class="fas fa-user text-green"></i> View</router-link>
                              <a  class="dropdown-item"  href="#"@click="editUser(user.id)" ><i class="fas fa-edit text-blue"></i> Edit</a>
                              <a  class="dropdown-item" href="#" @click="deleteUser(user.id)"><i class="fas fa-trash text-red"></i> Delete</a>
                            </div>
                          </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            </div>
        </div>
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">{{editMode ? 'Edit' : 'Create'}} </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                 <form @submit.prevent="editMode ? updateUser() : createUser()" @keydown="form.onKeydown($event)">
                <div class="modal-body">
            
              <div class="form-group">
                <input v-model="form.name" type="text" name="name" placeholder="Name"
                  class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                <has-error :form="form" field="name"></has-error>
              </div>
              <div class="form-group">
                <input v-model="form.email" type="text" name="email" placeholder="Email"
                  class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                <has-error :form="form" field="email"></has-error>
              </div>
               <div class="form-group">
                <input v-model="form.password" type="text" name="password" placeholder="Password"
                  class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                <has-error :form="form" field="password"></has-error>
              </div>
              <div class="form-group">
                <input v-model="form.position" type="text" name="position" placeholder="Position"
                  class="form-control" :class="{ 'is-invalid': form.errors.has('position') }">
                <has-error :form="form" field="position"></has-error>
              </div>
              <div class="form-group">
                <select v-model="form.type" type="text" name="type" placeholder="Type"
                  class="form-control" :class="{ 'is-invalid': form.errors.has('type') }">  
                <option value="">Select Type</option>
                <option value="admin">Admin</option>
                <option value="employee">Employee</option>
                <option value="visitor">Visitor</option>
                </select>
                <has-error :form="form" field="type"></has-error> 
              </div>
                <div class="form-group">
                <textarea v-model="form.bio" type="text" name="bio" placeholder="Enter a Short info about User"
                  class="form-control" :class="{ 'is-invalid': form.errors.has('bio') }">
                </textarea>
                <has-error :form="form" field="bio"></has-error>
              </div>
         
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button v-show="editMode" :disabled="form.busy" type="submit"class="btn btn-success">Update</button>
                  <button v-show="!editMode" :disabled="form.busy" type="submit"class="btn btn-primary">Create</button>
                </div>
                 </form>
              </div>
            </div>
          </div>
    </div>
</template>

<script>
    export default {
       data () {
          return {
            editMode : false,
            users:{},
            // Create a new form instance
            form: new Form({
              id:'',
              name: '',
              email: '',
              password: '',
              position: '',
              type: '',
              bio: '',
            })
          }
       },
        methods:{
          loadUsers(){
             axios.get('api/user')
             .then(({ data }) => { this.users = data});
            },
          updateUser(){
            this.$Progress.start()
             this.form.put('api/user/' + this.form.id)
             .then(({data})=>{
                Toast.fire({
                          icon: 'success',
                          title: 'User Updated'
                        })
                 Trigger.$emit('AfterCreate')
                $('#exampleModalCenter').modal('hide')
                 this.form.reset()
                //clear field
                this.form.clear()
                
                this.$Progress.finish()
               }).catch(()=>{
                 this.$Progress.fail()
               })
          },
          editUser(id){
            
            axios.get('api/user/' + id).then(({data})=>{
              this.form.fill(data)
              this.editMode = true
              $('#exampleModalCenter').modal('show')
              console.log(data)
            })
          },
          deleteUser(id){
            Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                  }).then((result) => {
                    if (result.value) {
                       axios.delete('api/user/' + id).then(({data})=>{
                        console.log(data)})
                        Swal.fire(
                          'Deleted!',
                          'Your file has been deleted.',
                          'success'
                        )
                        Trigger.$emit('AfterCreate')
                    }
                  })
                               
          },
          createUser(){
            this.$Progress.start()
            this.form.post('api/user')
             .then(({ data }) => { 
              $('#exampleModalCenter').modal('hide')
              //closes modal
              this.form.reset()
              //clear field
              this.form.clear()
              //clear errors
              Toast.fire({
                          icon: 'success',
                          title: 'User Created'
                        })
             //alert success
             Trigger.$emit('AfterCreate')
              //reload users
             this.$Progress.finish()
             })
             .catch(()=>{
               this.$Progress.fail()
             });
             //finish progress line
          //  this.$Progress.fail()
          },     
        },
        mounted() {
         this.loadUsers();
            
        },
          created(){
            this.loadUsers();
            Trigger.$on('AfterCreate',() =>{
               this.loadUsers();
            })
          }
    }
    
</script>
