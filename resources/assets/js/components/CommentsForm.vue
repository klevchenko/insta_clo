<template>
    <div>

        <h4>Add comment</h4>
        <form id="newcommentform" v-on:submit.prevent="postComment">
            <textarea name="comment" id="comment"></textarea>
            <button type="submit" class="btn btn-sm btn-primary">Comment</button>
        </form>

    </div>
</template>

<script>
    export default {

        props: ['userId', 'postId'],

        mounted() {
            console.log('Component mounted.')
        },


        methods: {

           postComment(){
                let comment = document.getElementById('comment').value

                axios.post('/comment', {
                    comment: comment,
                    userId: this.userId,
                    postId: this.postId,
                })
                .then(resp => {
                    console.log(resp);
                });
           }

        },

        computed: {


        }
    }
</script>
