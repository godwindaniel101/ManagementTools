<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card table-responsive p-0">
                    <div class="card-header">
                        <h3 class="card-title"> View Sales</h3>
                    </div>
            
                <table class="table table-hover">
                <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Unit Cost</th>
                    
                    <th>Net</th>
                    <th>Sales Date</th>
                    <th>Net Sale</th>
                    <th>Action</th>
                </tr>
                </thead>
                </tbody>
                <tr v-for="sales_record in sales" :key="sales_record.id">
                    <td>{{sales_record.product}}</td>
                    <td>{{sales_record.product_quantity}}</td>
                    <td>{{sales_record.product_cost}}</td>
                     <td>{{sales_record.unitNet}}</td>
                    <td>{{sales_record.created_at | dateChange}}</td>
                    <td>{{sales_record.unitTotal}}</td>
                   
                    <td>
                        <div class="dropdown show">
                            <a class="btn btn-outline-success dropdown-toggle" href="#" role="button" id="dropdownMenuLink" 
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Action
                            </a>
                            <div class="dropdown-menu " aria-labelledby="dropdownMenuLink">
                             
                              <a  class="dropdown-item"  href="#"@click="editProduct(sales_record.id)" ><i class="fas fa-edit text-blue"></i> Edit</a>
                              <a  class="dropdown-item" href="#" @click="deleteProduct(sales_record.id)"><i class="fas fa-trash text-red"></i> Delete</a>
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
                    <h5 class="modal-title">Edit Product</h5>
                    <button type="button" class="close"  @click="clearfield"  aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <form @submit.prevent="Update" @keydown="form.onKeydown($event)">
                <div class="modal-body">
                         <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">     
                                        <select v-model="form.product_id"  type="text" class="form-control" @change="productSelected(form.product_id)">
                                              <option value="">Choose Product..!</option>
                                              <option v-for="product in products" :value="product.id" :key="products.id">{{product.product_name}}</option>
                                        </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                <label>Product Cost</label>
                                <input v-model="form.product_cost" type="number" name="product_cost" @click="getTotal" @keyup="getTotal"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('product_cost') }">
                                <has-error :form="form" field="product_cost"></has-error>
                                </div>
                            </div>
                             <div class="col-md-12">
                                <div class="form-group">
                                <label>Product Quantity</label>
                                <input v-model="form.product_quantity" type="number" name="product_quantity"  @click="getTotal" @keyup="getTotal"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('product_quantity') }">
                                <has-error :form="form" field="product_quantity"></has-error>
                                </div>
                            </div>
                             <div class="col-md-12">
                                <div class="form-group">
                                <label>Total</label>
                                <input v-model="form.unitTotal" type="number" name="unitTotal"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('unitTotal') }" disabled>
                                <has-error :form="form" field="unitTotal"></has-error>
                                </div>
                            </div>
                        </div>                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"   @click="clearfield">Close</button>
                   
                      <button :disabled="form.busy"  type="submit" class="btn btn-primary">Update</button>
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
            sales : {},
            products : {},
            form : new Form ({
                id: ' ',
                product_quantity: ' ',
                product_cost: ' ',
                product_id: ' ',
                unitTotal: ' ',
                created_at: ' ',
            })
            }
        },
        methods :{
         getSales(){
             axios.get('api/sales').then(({data})=>{
                 this.sales = data;
                    console.log(this.sales);
             }).catch(({})=>{

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
                       axios.delete('api/sales/' + id).then(({data})=>{
                        console.log(data)})
                        Swal.fire(
                          'Deleted!',
                          'Sales Record has been deleted.',
                          'success'
                        )
                        this.getSales();
                    }
                  })
        },
        editProduct(id){
             this.getProduct()
            axios.get('api/sales/' + id).then(({data})=>{
                this.form.fill(data)
            })      
             $('.modal').modal('show'); 
        },
        clearfield(){
            this.form.reset();
            $('.modal').modal('hide')
        },
        getProduct(){
            axios.get('api/product').then(({data})=>{
                this.products = data;
            }).catch(()=>{})
        },
        productSelected(id){
             axios.get('api/getCost/' + id).then(({data})=>{
                 this.form.product_cost = data.product_code;
             });
             this.getTotal()
        },
        getTotal(){
             this.form.unitTotal = this.form.product_cost * this.form.product_quantity
        },
        Update(){
            this.$Progress.start()
            var id = this.form.id;
            this.form.put('api/sales/' + id).then(({data})=>{
                // console.log(data);
            this.getSales();
                Toast.fire({
                          icon: 'success',
                          title: 'Sales Updated'
                        })
            this.$Progress.finish()
            this.clearfield()
           
            }).catch(({})=>{
            this.$Progress.fail()
            });
        },
        },
        mounted() {
           this.getSales();
        }
    }
</script>
