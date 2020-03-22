<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                 <ol>
    <!--
      Now we provide each todo-item with the todo object
      it's representing, so that its content can be dynamic.
      We also need to provide each component with a "key",
      which will be explained later.
    -->
    <todo-item
      v-for="item in groceryList"
      v-bind:todo="item"
      v-bind:key="item.id"
    ></todo-item>
  </ol>
            </div>
        </div>
    </div>
</template>

<script>
    export default 
    {
        data(){
            return{
                    groceryList: [
                        { id: 0, text: 'Vegetables' },
                        { id: 1, text: 'Cheese' },
                        { id: 2, text: 'Whatever else humans are supposed to eat' }
                        ]
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
