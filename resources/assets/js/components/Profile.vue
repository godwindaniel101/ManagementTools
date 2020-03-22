<template>
    <div class="container">
 
        <div class="row">
            <div class="col-md-3">
              <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle" :src="getPhoto()"  alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">{{user.name}}</h3>

                <p class="text-muted text-center">{{user.position}}</p>

                 <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Email</b> <a class="float-right">{{user.email}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>ACL</b> <a class="float-right">{{user.type | textTransform}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Date Joined</b> <a class="float-right">{{user.created_at | dateChange}}</a>
                  </li>
                </ul>

                <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
              </div>
              <!-- /.card-body -->
            </div>
            </div>
            <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Activity</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane active" id="activity">
               
                    <!-- Post -->
                    <div class="post">
                      <div class="user-block">
                        <img class="img-circle img-bordered-sm" :src="'/image/icon.png'" alt="User Image">
                        <span class="username">
                          <a href="#">Adam Jones</a>
                          <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                        </span>
                        <span class="description">Posted 5 photos - 5 days ago</span>
                      </div>
                      <!-- /.user-block -->
                     
                      <!-- /.row -->

                      <p>
                        <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a>
                        <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i> Like</a>
                        <span class="float-right">
                          <a href="#" class="link-black text-sm">
                            <i class="far fa-comments mr-1"></i> Comments (5)
                          </a>
                        </span>
                      </p>

                      <input class="form-control form-control-sm" type="text" placeholder="Type a comment">
                    </div>
                    <!-- /.post -->
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="timeline">
                    <!-- The timeline -->
                    <div class="timeline timeline-inverse">
  
                    </div>
                  </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="settings">
            <div class="row">
              <div class="col-5 col-sm-3">
                <div class="nav flex-column nav-tabs" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                  <a class="nav-link active" id="vert-tabs-home-tab" data-toggle="pill" href="#vert-tabs-home" role="tab" aria-controls="vert-tabs-home" aria-selected="true">Photo</a>
                  <a class="nav-link" id="vert-tabs-profile-tab" data-toggle="pill" href="#vert-tabs-profile" role="tab" aria-controls="vert-tabs-profile" aria-selected="false">Password</a>
                  <a class="nav-link" id="vert-tabs-messages-tab" data-toggle="pill" href="#vert-tabs-messages" role="tab" aria-controls="vert-tabs-messages" aria-selected="false">Documents</a>
                  <a class="nav-link" id="vert-tabs-settings-tab" data-toggle="pill" href="#vert-tabs-settings" role="tab" aria-controls="vert-tabs-settings" aria-selected="false">Details</a>
                </div>
              </div>
              <div class="col-7 col-sm-9">
                <div class="tab-content" id="vert-tabs-tabContent">
                  <div class="tab-pane text-left fade active show" id="vert-tabs-home" role="tabpanel" aria-labelledby="vert-tabs-home-tab">
                      <form @submit.prevent="updatePhoto()" @keydown="form.onKeydown($event)">
                     <div class="row">
                     
                     <div class="col-sm-5">
                        <div  style="display:flex;justify-content:center;">
                            <img :src="getPhoto()" class="img-responsive" alt="black sample" style="width:161px;">
                        </div>
                       </div>
                       
                        <div class="row">
                       <div class="col-sm-6">              
                            <div class="input-group">
                                <div class="file-upload">
                                  <label for="upload" class="file-upload__label"  ><i class="nav-icon fas fa-camera"></i></label>
                                  <input id="upload"  @change="updatePhotoAction" class="file-upload__input" type="file" name="file-upload">
                                </div>
                            </div>                      
                       </div>
                        </div> 
                       <div class="col-sm-12">
                          <div class="modal-footer">
                              <button :disabled="form.busy" type="submit"class="btn btn-success">Update</button>
                          </div>
                       </div>
                       </div>
                         
                          
                      
                       </form>              
                  </div>
                  <div class="tab-pane fade" id="vert-tabs-profile" role="tabpanel" aria-labelledby="vert-tabs-profile-tab">
                  <form @submit.prevent="changePassword()" @keydown="form.onKeydown($event)">
                         <div class="form-group" style="display:flex;flex-direction:row;">
                         <div style="width:93%;">
                          <input v-model="passwordForm.old_password" v-bind:type="textaaa" name="old_password" placeholder="Old Password" id="old_password"
                            class="form-control"  @change="oldPassword" :class="{ 'is-invalid': passwordForm.errors.has('old_password') }"
                            style="border-right:none;border-top-left-radius:0;border-bottom-right-radius:0;">
                          <has-error :form="passwordForm" field="old_password"></has-error>
                         
                         </div>
                          <div class="form-control"style="width:7% ;border-left:none;border-radius-top-left:0border-radius-bottom-right:0;">
                         <i v-show="!showMode" @click="awonSet"class="fas fa-eye "></i>
                         <i v-show="showMode" @click="awonSet"class="fas fa-eye-slash "></i>
                         </div>
                        </div>  
                          <div class="form-group">
                          <input v-model="passwordForm.new_password" type="text" name="new_password" placeholder="New Password"
                            class="form-control" :class="{ 'is-invalid': passwordForm.errors.has('new_password') }">
                          <has-error :form="passwordForm" field="new_password"></has-error>
                        </div>  
                          <div class="form-group">
                          <input v-model="passwordForm.confirm_password" type="text" name="confirm_password" placeholder="Confirm Password"
                            class="form-control" :class="{ 'is-invalid': passwordForm.errors.has('confirm_password') }">
                          <has-error :form="passwordForm" field="confirm_password"></has-error>
                        </div>  
                           <div class="modal-footer">
                                  <button type="submit"class="btn btn-success">Change</button>
                          </div>
                  </form>  
                  </div>
                  <div class="tab-pane fade" id="vert-tabs-messages" role="tabpanel" aria-labelledby="vert-tabs-messages-tab">
                  
                  </div>
                  <div class="tab-pane fade" id="vert-tabs-settings" role="tabpanel" aria-labelledby="vert-tabs-settings-tab">
                      <form @submit.prevent="createUser()" @keydown="form.onKeydown($event)">
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
                                <textarea v-model="form.bio" type="text" name="bio" placeholder="Enter a Short info about User"
                                  class="form-control" :class="{ 'is-invalid': form.errors.has('bio') }">
                                </textarea>
                                <has-error :form="form" field="bio"></has-error>
                              </div>
                              </div>
                                <div class="modal-footer">
                                  <button   @click.prevent="updateUser"
                                  type="submit"class="btn btn-success">Update</button>
                              </div>
                                </form>
                  </div>
            </div>
          </div>
          <!-- /.card -->
        </div>





















              <!-- /.card-header -->
              <!-- form start -->
             
               
            </div>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
      data(){
        return{
          user:{},
          textaaa: 'password',
          showMode : false,
           form: new Form({
              id:'',
              name: '',
              email: '',
              password: '',
              position: '',
              type: '',
              bio: '',
              photo :''
            }),
          photoForm : new Form({
            photo:'',
          }),
          passwordForm : new Form({
            old_password : '',
            new_password : '',
            confirm_password : '',
          }),
        }
      }, 
      methods :{ 
        //uploading picture for current user 
        awonSet(){
          this.showMode = !this.showMode
          if(this.showMode){
           this.textaaa = 'password';
          }else{this.textaaa = 'text';}
        },
        updatePhoto(){
            this.$Progress.start();
            this.photoForm.post('api/uploadPhoto')
            .then(({data})=>{
                    this.$Progress.finish();
                    Toast.fire({
                              icon: 'success',
                              title: 'Profile Picture Updated'
                            })
                    })
            .catch(({})=>{
                        this.$Progress.fail();
                      })
        },
        //get profile picture
        getPhoto(){
          let photo = (this.photoForm.photo.length > 200 ) ? this.photoForm.photo : 'image/profile/' + this.photoForm.photo ;
          return photo;      
        },
      //check photo size
        updatePhotoAction(element){
          let file = element.target.files[0];
          let reader = new FileReader();
            console.log(file['size']);
            if(file['size'] < 2111775){
               reader.readAsDataURL(file);
                 reader.onloadend = (file) => {
            this.photoForm.photo = reader.result;
            // console.log('RESULT', reader.result)
          }
            }else{
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'File Size too large(max:2MB)!'
            })
          }
        },


        changePassword(){
          this.$Progress.start();
          this.passwordForm.post('api/changePassword')
          .then(({data})=>{
          this.passwordForm.old_password = '',
          this.passwordForm.new_password = '',
          this.passwordForm.confirm_password = '',
          this.$Progress.finish();
            Toast.fire({
                        icon: 'success',
                        title: 'Password Changed '
                      })
          
          
          }).catch(()=>{
            this.$Progress.fail();
            
          });
        },
        oldPassword(){
          this.passwordForm.post('api/passwordCheck')
          .then(({data})=>{})
          .catch(()=>{});
        }
        ,
        updateUser(){
             this.$Progress.start();
            this.form.put('api/profile')
             .then(({data})=>{ 
              
               this.$Progress.finish()})
                  Toast.fire({
                        icon: 'success',
                        title: 'Info Updated'
                })
             .catch(({})=>{ this.$Progress.fail()});
        },
      },
        mounted() {
            console.log('Component mounted.')
        },
        created(){
        axios.get('api/profile').then(({data})=>{this.user = data; 
        this.form.fill(data);
        this.photoForm.fill(data)
        })
        }
    }
</script>
