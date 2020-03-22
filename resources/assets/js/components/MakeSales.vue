<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                     <i class="fas fa-plus-circle"  @click="addRows"  style="font-size:40px;"></i>
                         <form @submit.prevent="create" @keydown="form.onKeydown($event)">
                         <div class="row">
                         <table style="width:100%;text-align:left;">
                         <tr >
                            <th><label>Product </label></th>
                            <th style="width:10%"><label>Qty.a </label></th>
                            <th><label>Cost</label></th>
                            <th><label>Quantity</label></th>
                            <th><label>Discount(%)</label></th>
                            <th><label>Total</label></th>
                            <th><label></label></th>
                         </tr>
                         
                            <tr class="sales_table"v-for="(newdata, index) in form.newdatas" :key="index"> 
                             <td>
                                <div class="form-group">     
                                        <select v-model="newdata.product_id" @change="productSelected(index)" type="text" :name="'product_name'+[index]"  :id="'product_'+ [index]" class="form-control">
                                              <option value="">Choose Product..!</option>
                                              <option v-for="product in products" :value="product.id" :key="products.id">{{product.product_name}}</option>
                                        </select>
                                        <span  id="error_box" v-text="newdata.product_id_error">ssd</span>
                                </div>
                                
                            </td>
                            <td style="width:10%">
                                <div class="form-group">      
                                    <input v-model="newdata.product_count" type="number" @keyup="unitCost(index)" @change="unitCost(index)" class="form-control" disabled>
                                    <span  id="error_box" v-text="newdata.product_count_error"></span>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">      
                                    <input v-model="newdata.product_cost" type="number" @keyup="unitCost(index)" @change="unitCost(index)" class="form-control" >
                                 <span  id="error_box" v-text="newdata.product_cost_error"></span>
                                </div>
                            </td>
                            <td>
                                 <div class="form-group">
                                     <input v-model="newdata.product_quantity"  type="number" @keyup="unitCost(index)" @change="unitCost(index)" class="form-control" >
                                    <span id="error_box" v-text="newdata.product_quantity_error"></span>
                                </div>
                            </td>
                             <td style="width:10%">
                                <div class="form-group">      
                                    <input v-model="newdata.discount" type="number" @keyup="unitCost(index)" @change="unitCost(index)" class="form-control" >
                                </div>
                            </td>
                            <td>
                                  <div class="form-group">                               
                                    <input v-model="newdata.unitTotal" type="number" name="product_quantity" disabled class="form-control" >
                                </div>
                            </td>
                            <td id="trasha">
                                    <i class="fas fa-trash" @click="removeRow(index)"></i>
                            </td>
                            </tr>
                            </table>
                        </div>
                        <div class="row">
                        <div class="col-lg-10"></div>
                        <div class="col-lg-2">
                               <div class="form-group">
                                    <input v-model="form.total_cost" type="number" name="product_quantity" class="form-control" disabled>
                                </div>
                            </div>
                        </div>
                          <div class="modal-footer">
                            <button  type="submit" class="btn btn-primary">Create</button>                        
                        </div>
                    </form>
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
            form : new Form ({
                product_cost : {},
                product_name : '',
                product_quantity : '',
                total_cost : 0 ,
            }),
             products : {},
             form : new Form ({
           
            newdatas : [],
            product_quantity:'',
            product_count:'',
            product_cost:'',
            product_id:'',
            discount:'',
            unitTotal:'',
            total_cost : 0 ,
            product_quantity_error : 0,
            product_id_error : 0,
            product_count_error:0,
            product_cost_error:0,
             }),
            };
        },
        methods:{
        create(){
            // console.log(this.validator());
        if(this.validator()){
          this.$Progress.start()
            this.form.post('api/sales').then(({data})=>{
                this.form.newdatas = [],
                this.form.total_cost = 0;
                 this.addRows();
                  Toast.fire({
                          icon: 'success',
                          title: 'Sales Made'
                        })
              this.$Progress.finish()
            }).catch(({})=>{
                this.$Progress.fail()
            });
        }
        },
        getProduct(){
            axios.get('api/product').then(({data})=>{
                this.products = data;
            }).catch(()=>{})
        },
        productSelected(index){
         var id = this.form.newdatas[index]['product_id'];
           if(Number.isInteger(id))
          {  axios.get('api/getCost/' + id).then(({data})=>{
                this.form.newdatas[index]['product_cost'] = data.product_cost;  
                this.form.newdatas[index]['product_count'] = data.product_count;  
                this.form.newdatas[index]['product_quantity'] = 1; 
                this.form.newdatas[index]['discount'] = 0;
                 this.unitCost(index);
            })}else{
                this.form.newdatas[index]['product_cost'] = 0; 
                this.form.newdatas[index]['product_count'] = 0;  
                this.form.newdatas[index]['product_count'] = 0;  
                this.form.newdatas[index]['product_quantity'] = 1; 
                this.form.newdatas[index]['discount'] = 0;
                 this.unitCost(index);
            }
           
        },
        unitCost(index){
         var  product_cost =  this.form.newdatas[index]['product_cost']
         var  product_quantity = this.form.newdatas[index]['product_quantity']
         var  discount = this.form.newdatas[index]['discount']
         if(discount == 0 || discount == null){
            this.form.newdatas[index]['unitTotal'] = product_cost * product_quantity ;
         }else{
         this.form.newdatas[index]['unitTotal'] =(product_cost * product_quantity)-(product_cost * product_quantity * discount / 100); 
         }
         this.totalCost();
        },
        totalCost(){
            var unitUnit = 0;
            for(var i = 0 ; i< this.form.newdatas.length ; i++){
                unitUnit += this.form.newdatas[i]['unitTotal']
            }
            this.form.total_cost = unitUnit;
            
        },
        addRows(){
            let checkEmptyLines = this.form.newdatas.filter(newdata => this.form.newdatas.number === null)

            if (checkEmptyLines.length >= 1 && this.form.newdatas.length > 0) 
            {
                return
            } 

            this.form.newdatas.push({
                product_quantity: null,
                product_count: null,
                product_cost: null,
                product_id: null,
                unitTotal : null,
                discount:null,
                product_quantity_error:null,
                product_id_error:null,
                product_count_error:null,
                product_cost_error:null,
            });
        },
        removeRow(row){    
            this.form.newdatas.splice(row , 1);
             this.totalCost();
             
         },
         validator(){
             var error = 0;
             for(var i = 0 ; i< this.form.newdatas.length ; i++){
                if(this.form.newdatas[i]['product_quantity'] == null || this.form.newdatas[i]['product_quantity'] < 1 ){
                    this.form.newdatas[i]['product_quantity_error'] = '*required'
                    error++
                }else{
                    this.form.newdatas[i]['product_quantity_error'] = ''
                 
                };                                 
                 if(this.form.newdatas[i]['product_id'] == null || this.form.newdatas[i]['product_id'] < 1 ){
                     this.form.newdatas[i]['product_id_error'] = '*Select Product'
                     error++
                }else{
                 this.form.newdatas[i]['product_id_error'] = ''
                  };
                 if(this.form.newdatas[i]['product_count'] == null || this.form.newdatas[i]['product_count'] < 1 ){
                     this.form.newdatas[i]['product_count_error'] = '*Required'
                     error++
                }else if(this.form.newdatas[i]['product_count'] == 0){
                    this.form.newdatas[i]['product_count_error'] = '*Out Of Stock'
                     error++
                }
                
                else{
                 this.form.newdatas[i]['product_count_error'] = ''
                  };
                if(this.form.newdatas[i]['product_cost'] == null || this.form.newdatas[i]['product_cost'] < 1 ){
                     this.form.newdatas[i]['product_cost_error'] = '*Enter Cost'
                     error++
                }else{
                 this.form.newdatas[i]['product_cost_error'] = ''
                  };
             }
            //  console.log(error)
             if(error > 0){
                 return false
             }return true;
          }
        },
        mounted() {
            this.getProduct();
            this.addRows();
        }
    }
</script>
