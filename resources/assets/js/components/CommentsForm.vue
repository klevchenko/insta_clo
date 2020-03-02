<template>
    <div>

        <section v-if="errored">
            <p>We're sorry, we're not able to retrieve comments</p>
        </section>

        <section v-else class="comments">
            <div v-if="loading">Loading...</div>

            <div
                    v-else
                    v-for="comment in comments"
                    class="comment my-2"
            >
                <a v-bind:href="'/profile/'+ comment.user.id"><strong>{{ comment.user.username }}: </strong></a>
                {{ comment.text }}

                <button
                        class="badge badge-pill badge-danger d-inline border-0"
                        v-on:click="destroyComment(comment.id)"
                        v-if="user_id == comment.user.id">
                    del
                </button>

                <hr>

            </div>

        </section>

        <h4>Add comment</h4>
        <form id="newcommentform" v-on:submit.prevent="postComment">
            <div class="form-group">
                <textarea class="form-control" name="comment" id="comment" v-model="comment_text"></textarea>
                <button type="submit" class="btn btn-sm btn-primary my-2">Comment</button>
            </div>
        </form>

    </div>
</template>

<script>
    export default {

        props: ['userId', 'postId'],

        data() {
            return {
                comment_text: '',
                comments: null,
                loading: true,
                errored: false,
                user_id: this.userId
            }
        },

        mounted() {
            console.log('Component mounted.');

            axios
                .get('/comments/' + this.postId)
                .then(response => {
                    this.comments = response.data;
                })
                .catch(error => {
                    console.log(error);
                    this.errored = true
                })
                .finally(() => this.loading = false);

        },
        methods: {

            postComment() {

                axios.post('/comment', {
                    comment: this.comment_text,
                    userId: this.userId,
                    postId: this.postId,
                })
                    .then(resp => {
                        this.comments.unshift(resp.data);
                        this.comment_text = '';
                    })
                    .catch(error => {
                    console.log(error);
                })
            },

            destroyComment(comment_id){
                axios.delete('/comment/'+comment_id)
                .then(resp => {

                    // remove comment from list
                    if(resp.data.status == true){
                        for(var i = 0; i < this.comments.length; i++) {
                            if(this.comments[i].id == resp.data.id) {
                                this.comments.splice(i, 1);
                                break;
                            }
                        }
                    }

                })
                .catch(error => {
                    console.log(error);
                });
            }

        },

        computed: {}
    }
</script>
