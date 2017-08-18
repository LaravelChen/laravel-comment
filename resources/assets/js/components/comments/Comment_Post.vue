<template>
    <div>
        <hr>
        <comment_root :post_id="post_id" :user_id="user_id" :comments="comments" :collections="comment_list"></comment_root>
        <hr>
        <form method="POST" @submit.prevent="post_comment" accept-charset="UTF-8">
            <div class="form-group">
                <label for="comment" class="control-label">Info:</label>
                <textarea v-model="comment_content" id="comment" name="comment" rows="4" class="form-control"
                          placeholder="请填写您的评论"
                          required="required"></textarea>
            </div>
            <button type="submit" class="btn btn-success form-control">提交评论</button>
        </form>
    </div>
</template>
<script>
    export default{
        props:['post_id','collections','comments','user_id'],
        data(){
            return{
              comment_content:'',
              comment_list:this.collections,
            }
        },
        methods:{
            post_comment(){
                axios.post('/post/'+this.post_id+'/comments',{'body':this.comment_content}).then((response)=>{
                    if(response.data.success){
                        this.comment_list.push(response.data.reply_block);
                        this.comment_content='';
                    }
                });
            },
        },
    }
</script>
