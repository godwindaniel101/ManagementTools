<template>
    <div class="container">
        <div class="row">
            <div class="col-md-3" >
            <div class="info-box">
              <div class="info-box-content"  >
                    <div class="checkbox" >
                        <label>
                        <input type="checkbox" v-model="status" @change="updateStatus">
                        Hide Message Read
                        </label>
                    </div>
              </div>
              <!-- /.info-box-content -->
            </div>
          
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                status: '',
            }
        },
        methods:{
    updateStatus () {
        alert(this.status);
        },
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
