<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
             <div class="card table-responsive p-0">
               <div class="card-header">
                <h3 class="card-title"> Products</h3>

                <div class="card-tools">
                  <i class="fas fa-plus-circle" data-toggle="modal" data-target=".modal" style="font-size:40px;"></i>
                </div>
              </div>
            
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>S/N</th>
                      <th>Product</th>
                      <th>Cost</th>
                      <th>Price</th>
                      <th>Supplier</th>
                      <th>Maximum Qty</th>
                      <th>Warning Qty</th>
                      <th>Current Qty</th>
                      <th>Created </th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(product,index) in products" :key="products.id">
                      <td>{{index + 1}}</td>
                      <td>{{product.product_name | textTransform}}</td>
                      <td>{{product.product_cost}}</td>
                      <td>{{product.product_price}}</td>
                      <td>{{product.product_supplier}}</td>
                      <td>{{product.product_max}}</td>
                      <td>{{product.product_warn}}</td>
                      <td>{{product.product_count}}</td>
                      <td>{{product.created_at | dateChange}}</td>
                      <td>
                          <div class="dropdown show">
                            <a class="btn btn-outline-success dropdown-toggle" href="#" role="button" id="dropdownMenuLink" 
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Action
                            </a>
                            <div class="dropdown-menu " aria-labelledby="dropdownMenuLink">
                              <a  class="dropdown-item"  href="#"@click="edit(product.id)" ><i class="fas fa-edit text-blue"></i> Edit</a>
                              <a  class="dropdown-item" href="#" @click="deleteProduct(product.id)"><i class="fas fa-trash text-red"></i> Delete</a>
                            </div>
                          </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
        </div>
        <div class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{editMode ? 'Edit Product' : 'Create Product'}}</h5>
                    <button type="button" class="close" @click="clearfield"  aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <form @submit.prevent="editMode ? update() : create()" @keydown="form.onKeydown($event)">
                <div class="modal-body">
                         <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                <input v-model="form.product_name" type="text" name="product_name" placeholder="Product Name"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('product_name') }">
                                <has-error :form="form" field="product_name"></has-error>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                <input v-model="form.product_cost" type="number" name="product_cost" placeholder="Product Cost"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('product_cost') }">
                                <has-error :form="form" field="product_cost"></has-error>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                <input v-model="form.product_price" type="number" name="product_price" placeholder="Product Price"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('product_price') }">
                                <has-error :form="form" field="product_price"></has-error>
                                </div>
                            </div>
                               <div class="col-md-12">
                                <div class="form-group">
                                <input v-model="form.product_supplier" type="text" name="product_supplier" placeholder="Supplier"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('product_supplier') }">
                                <has-error :form="form" field="product_supplier"></has-error>
                                </div>
                            </div>
                               <div class="col-md-12">
                                <div class="form-group">
                                <input v-model="form.product_warn" type="number" name="product_warn" placeholder="Product Warning Quantity"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('product_warn') }">
                                <has-error :form="form" field="product_warn"></has-error>
                                </div>
                            </div>
                               
                               <div class="col-md-12">
                                <div class="form-group">
                                <input v-model="form.product_max" type="number" name="product_max" placeholder="Product Maximum Quantity"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('product_max') }">
                                <has-error :form="form" field="product_max"></has-error>
                                </div>
                            </div>
                              <div class="col-md-12">
                                <div class="form-group">
                                <input v-model="form.product_count" type="number" name="product_count" placeholder="Product Count"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('product_count') }">
                                <has-error :form="form" field="product_count"></has-error>
                                </div>
                            </div>
                        </div>                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"  @click="clearfield">Close</button>
                    <button :disabled="form.busy" v-show="!editMode" type="submit" class="btn btn-primary">Create</button>
                      <button :disabled="form.busy" v-show="editMode" type="submit" class="btn btn-primary">Update</button>
                </div>
                </form>
                </div>
            </div>
            </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
            form : new Form ({
                id : '',
                product_name : '',
                product_cost : '',
                product_price : '',
                product_count : '',
                product_supplier : '',
                product_max : '',
                product_warn : '',
            }), 
            products : {},
            editMode : false,
            };
            
            
        },
        methods:{
        getproduct(){
            axios.get('api/product').then(({data})=>{
            this.products = data;
            // console.log(data);
            })
        },
        create(){
            this.$Progress.start()
            console.log(this.form);
            this.form.post('api/product')
            .then(({data})=>{
               this.$Progress.finish();
               Toast.fire({
                          icon: 'success',
                          title: 'Product Created'
                        })
                this.getproduct();
                $('.modal').modal('hide');
                this.form.reset();
               })
            .catch(()=>{
                this.$Progress.fail()
            })
        },
        edit(id){
            this.editMode = true;
            this.form.get('api/product/'+ id + '/edit')
            .then(({data})=>{       
                console.log(data); 
                 this.form.fill(data);   
                 $('.modal').modal('show');   
                  // this.editMode = false;      
            })
            .catch(()=>{});
        },
        update(){
           var id = this.form.id;
           this.$Progress.start()
            this.form.put('api/product/' + id).then(({data})=>{
                 console.log(data);
                  Toast.fire({
                          icon: 'success',
                          title: 'Product Updated'
                        })
                 $('.modal').modal('hide')
                  this.editMode = false;
                 this.getproduct();
                 this.$Progress.finish()
                 this.form.reset();
            

            }).catch(()=>{
                this.$Progress.fail()
            })
        },
        deleteProduct(id){
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
                       axios.delete('api/product/' + id).then(({data})=>{
                        console.log(data)})
                        Swal.fire(
                          'Deleted!',
                          'Your file has been deleted.',
                          'success'
                        )
                        this.getproduct();
                    }
                  })
        },
        clearfield(){
            this.form.reset();
            this.editMode = false;
            $('.modal').modal('hide')
        },
        },
        mounted() {
            console.log(this.editMode);
             this.getproduct();
        }
    }
</script>
