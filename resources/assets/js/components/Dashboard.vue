<template>
  
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{users_count}}</h3>

                <p>No Of Staffs</p>
              </div>
              <div class="icon">
                <i class="fas fa-users"></i>
              </div>
              <router-link to="/users" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></router-link>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{salesCount}}<sup style="font-size: 20px"></sup></h3>

                <p>Sales Count</p>
              </div>
              <div class="icon">
                <i class="fas fa-signal"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>44</h3>

                <p>Completed Task</p>
              </div>
              <div class="icon">
                <i class="fas fa-paper-plane"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>65</h3>

                <p>Rejected Task</p>
              </div>
              <div class="icon">
              <i class="fas fa-burn"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
            </div>
        </div>
    </div>
</template>

<script>
    export default {
      data (){
        return {
          users_count :'',
          salesCount :'',
        }
      },
      methods:{
        loadUsers(){
           axios.get('api/user')
             .then(  ({ data }) => {  this.users_count = (data).length});
        },
        loadSales(){
          axios.get('api/loadSales').then(({data}) => {
            this.salesCount = data;
          });
        },
      },
        mounted() {
          this.loadUsers()
          this.loadSales()
            console.log('Component mounted.')
        }
    }
</script>
