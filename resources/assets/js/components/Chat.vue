<template>
    <div class="container">
        <div class="row">
      
        <div class="col-lg-3 chat-contact">
            <ul  >
                <li v-for="unitcontact in contact">
                      <a @click="getMessage(unitcontact.id)">
                            <div class="contact-image">
                                <img class="contacts-list-img" :src="'/image/icon.png'" alt="Contact Avatar">
                            </div>
                            <div class="contact-detail">
                                <span class="contact-name">
                                    {{unitcontact.name}}
                                    <span class="contact-position">{{unitcontact.position}}</span>
                                </span>
                                <span class="contact-email">{{unitcontact.email}}
                                </span>
                            </div>
                        </a>
                </li>
            </ul>
        </div>
        <div class="col-lg-9 chat-message" v-chat-scroll>
                <div class="chat-message-header">
                     <p> {{contact_info.current_name ? contact_info.current_name : 'Select Chat'}} </p>
                </div>

                <div class="chat-message-content">
                <div class="msg-all"  v-for="unitmessage in messages">
                    <div class=""  v-bind:class="unitmessage.sender_id == contact_info.my_id ? 'msg-right' : 'msg-left'">
                   <p> {{unitmessage.message}}</p>
                        <span class="status-right">
                        <i class="fas fa-circle"  v-bind:class="unitmessage.reciever_status == 1 ? 'read' : 'unread'"></i></span>
                    <span class="msg-time"> {{unitmessage.created_at}}9</span></div>
                </div> 
                </div>
                <div class="chat-message-input">
                    <form @submit.prevent="sendMessage" @keydown="form.onKeydown($event)">
                                <div class="input-group">
                                    <input type="text" v-model="form.message" name="message" placeholder="Type Message ..." class="form-control">
                              
                                </div>
                            </form>
                </div>
        </div>
        
            <div class="col-md-4">
               <div class="card">
               <div class="box box-danger direct-chat direct-chat-danger">
                    <div class="box-header with-border" style="border-bottom:1px solid red;" >
                        <div class="box-tools pull-right">
                          <img class="direct-chat-img" :src="'/image/icon.png'" alt="message user image">
                         <p class="btn btn-box-tool">
                             {{contact_info.current_name ? contact_info.current_name : 'Select Chat'}}
                         </p>
                      </div>
                    </div>
                    <!-- /.box-header -->
                     <!-- Contacts are loaded here -->
                        <div class="direct-chat-contacts" style="height:440px;">
                            <ul class="contacts-list" v-for="unitcontact in contact">
                                <li>
                                    <a href="" @click="getMessage(unitcontact.id)">
                                        <img class="contacts-list-img" :src="'/image/icon.png'" alt="Contact Avatar">
                                            <div class="contacts-list-info">
                                                <span class="contacts-list-name">
                                                    {{unitcontact.name}}
                                                <span class="direct-chat-timestamp pull-right">{{unitcontact.position}}</span>
                                                </span>
                                                <span class="contacts-list-msg">{{unitcontact.email}}</span>
                                            </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.direct-chat-pane -->
                    <div class="box-body" style="height:350px;overflow-y:scroll;" v-chat-scroll>
                   <!-- Conversations are loaded here -->
                        <div class="direct-chat-messages" style="height:auto;" v-for="unitmessage in messages">
                            <div class="direct-chat-msg" v-bind:class="unitmessage.sender_id == contact_info.my_id ? 'left' : 'right'" >
                            <div class="direct-chat-text"> {{unitmessage.message}}
                                <i class="fas fa-circle" v-bind:class="unitmessage.reciever_status == 1 ? 'read' : 'unread'"></i>
                            </div>
                                <span class="" 
                                v-bind:class="unitmessage.sender_id == contact_info.my_id ? 'pull-left' : 'pull-right'" > {{unitmessage.created_at}}</span>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                        <div class="box-footer">
                            <form @submit.prevent="sendMessage" @keydown="form.onKeydown($event)">
                                <div class="input-group">
                                    <input type="text" v-model="form.message" name="message" placeholder="Type Message ..." class="form-control">
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-danger btn-flat">Send</button>
                                    </span>
                                </div>
                            </form>
                        </div>
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
            contact : {},
            messages :{},
            contact_info : {},
            form : new Form({
                message:'',
                reciever_id : '',
            }) 
            }
        },
        methods:{
        sendMessage(){
            this.form.post('api/chatcontrol').then(({data})=>{
                console.log(data)
                    this.form.message = '',
                this.getMessage(this.form.reciever_id);
            }).catch(()=>{
                
            })
            // alert(this.form.reciever_id);
        },
        getMessage(id){
            this.form.reciever_id = id;
            this.form.post('api/getMessage').then(({data})=>{
                this.messages = data;
                console.log(data)
            }).catch(()=>{});
               this.form.post('api/getDetail').then(({data})=>{
                this.contact_info = data;
                console.log(data)
            }).catch(()=>{});
        },
        getContact(){
            axios.get('api/chatcontrol').then(({data})=>{
                this.contact = data;
            }).catch(()=>{

            });
        },
        },
        mounted() {
            this.getContact()
            console.log('wahalaaaa.')
        }
    }
</script>
<style scoop>
.chat-contact{background:lightgrey;padding:0;border-right:1px solid white;}
.chat-contact ul{width:100%;
                list-style-type: none;
                display:flex;
                padding:0;
                margin:0;
                flex-direction:column;
                justify-content:start;
                align-items: flex-start;}
.chat-contact li {width:100%;
                height:auto;
                margin:5px 0;
                border-bottom:1px solid white;
                display:flex;align-self:flex-start;}
.chat-contact a:active{color:red;}
.contact-name {color:green;font-weight:700;font-size:16px;}
.contact-image {width:20%}
.chat-message {
                height:500px;
                padding:0;
                overflow:hidden;
                flex-direction:column;
                display:flex;}
.chat-message-header{height:10%;background:lightgrey;color:white;}
.chat-message-content{height:80%;overflow-y:scroll;}
.chat-message-content .msg-all {width:100%;min-height:50px; max-height:auto;margin:10px auto;display:inline-block;}
.chat-message-content .msg-left, .msg-right {min-height:50px;border:1px solid lightgrey;}
.chat-message-content .msg-left {min-width:40%;
                                 max-width:80%;
                                 float:left;
                                 padding:5px;
                                 background:#e6e6e6;
                                 color:black;
                                 position:relative;
                                 border-radius:20px 0px 20px 6px;}
.chat-message-content .msg-right {min-width:40%;
                                    max-width:80%;
                                    padding:5px;
                                    padding-bottom:0;
                                    position:relative;
                                    float:right;
                                    background: #f2f2f2;
                                    color:black;
                                    border-radius:0px 20px 6px 20px;}
.msg-time {color:grey;display:flex;font-size:10px;position:absolute;bottom:0;}
.msg-left .msg-time {align-self:flex-end}
.msg-right .msg-time {right:0}
.chat-message-content .status-left{float:right;margin-top:10%}
.chat-message-content .status-right{float:left;margin-top:10%; }
.chat-message-header p{color:green;font-weight:700;margin:auto;line-height:50px;}
.chat-message-input{height:10%;}
.chat-message-input input{width:100%;min-height:50px !important}
</style>
