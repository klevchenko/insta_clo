<template>
    <div>
         <button 
            @click="likePost" 
            v-bind:class="[status ? 'fa-heart' : 'fa-heart-o', def_classes]"
            ></button>
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
                def_classes : 'text-danger fa d-inline border-0 bg-transparent fs-2em',
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
    }
</script>
