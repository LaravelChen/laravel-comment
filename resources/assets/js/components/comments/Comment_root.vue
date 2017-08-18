<template>
    <div>
        <div v-for="comment in collections">
            <comment_child :post_id="post_id" :user_id="user_id" :comments="comments" :comment="comment" :collections="collections"></comment_child>
        </div>
    </div>

</template>
<script>
    export default{
        props:['collections','comments','user_id','post_id'],
    }
</script>
