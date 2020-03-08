<template>
    <div>
         <button @click="likePost" class="btn btn-sm btn-primary mx-2" v-text="btnText"></button>
    </div>
</template>

<script>
    export default {

        props: ['postId', 'like'],

        mounted() {
            console.log('Component mounted.')
        },

        data: function(){
            return{
                status: this.like,
            }
        },

        methods: {

           likePost(){
                axios.post('/like/'+this.postId)
                .then(resp => {
                    this.status = !this.status;
                });
           }
        },

        computed: {

           btnText(){
                return (this.status) ? 'Unlike' : 'Like';
           }

        }
    }
</script>
