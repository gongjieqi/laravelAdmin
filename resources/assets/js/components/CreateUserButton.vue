<template>
    <div>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Create</button>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">创建用户</h4>
                    </div>
                    <div class="modal-body">
                        <div class="error-message" v-show="has_error == 'yes'">
                            <ul>
                                <li v-for="error in post_message" style="color: red">{{ error }}</li>
                            </ul>
                        </div>
                        <form :action="action_url" method="post">
                            <div class="form-group">
                                <label class="control-label">用户名:</label>
                                <input type="text" class="form-control" name="name" v-model="name">
                            </div>
                            <div class="form-group">
                                <label class="control-label">密码:</label>
                                <input type="password" class="form-control" name="password" v-model="password">
                            </div>

                            <div class="form-group">
                                <label class="control-label">重复密码:</label>
                                <input type="password" class="form-control" name="password_confirmation" v-model="password_confirmation">
                            </div>

                            <div class="form-group">
                                <label class="control-label">角色:</label>
                                <li v-for="role in allroles">
                                    <input  :value="role.id" type="checkbox" name="role_ids[]" v-model="check_roles">{{ role.display_name }}
                                </li>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                        <button type="button" class="btn btn-primary" v-on:click="sumbit">提交</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script type="text/ecmascript-6">
    export default {
        props:['action_url','roles'],
        data(){
            return {
                allroles: eval('('+this.roles+')'),
                name:'',
                password:'',
                password_confirmation:'',
                check_roles:[],
                has_error:'no',
                post_message:[],
            }
        },
        mounted() {
        },
        methods:{
            sumbit(){
                this.$http.post(this.action_url,{'name':this.name,'password':this.password,'password_confirmation':this.password_confirmation,'role_ids':this.check_roles}).then(response => {
                    window.location.reload();
                },function(response){
                    this.has_error = 'yes';
                    this.post_message = [];
                    var message = [];
                    $.each(response.body.errors,function(i,n){
                        message.push(n[0]);
                    });
                    this.post_message = message;
                })
            }
        },
    }
</script>