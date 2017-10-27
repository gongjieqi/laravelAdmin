<template>
    <div>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Create</button>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">创建角色</h4>
                    </div>
                    <div class="modal-body">
                        <div class="error-message" v-show="has_error == 'yes'">
                            <ul>
                                <li v-for="error in post_message" style="color: red">{{ error }}</li>
                            </ul>
                        </div>
                        <form :action="action_url" method="post">
                            <div class="form-group">
                                <label class="control-label">角色显示名称:</label>
                                <input type="text" class="form-control" name="display_name" v-model="display_name">
                            </div>
                            <div class="form-group">
                                <label class="control-label">角色名称:</label>
                                <input type="text" class="form-control" name="name" v-model="name">
                            </div>

                            <div class="form-group">
                                <label class="control-label">权限:</label>
                                <li v-for="(item,index) in allpermission">
                                    <br v-if="item.fid == '0'">
                                    <input  :value="item.id" type="checkbox" name="check_permission[]" v-model="check_permissions">{{ item.display_name }}
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
        props:['action_url','permission'],
        data(){
            return {
                allpermission: eval('('+this.permission+')'),
                name:'',
                display_name:'',
                check_permissions:[],
                fid:'',
                has_error:'no',
                post_message:[],
            }
        },
        mounted() {
        },
        methods:{
            sumbit(){
                this.$http.post(this.action_url,{'name':this.name,'display_name':this.display_name,'permission_ids':this.check_permissions}).then(response => {
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