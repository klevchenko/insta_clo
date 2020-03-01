<template>
    <div>
         <button @click="followUser" class="btn btn-sm btn-primary m-3" v-text="btnText"></button>
    </div>
</template>

<script>
    export default {

        props: ['userId', 'follows'],

        mounted() {
            console.log('Component mounted.')
        },

        data: function(){
            return{
                status: this.follows,
            }
        },

        methods: {

           followUser(){
                axios.post('/follow/'+this.userId)
                .then(resp => {
                    this.status = !this.status;
                });
           }
        },

        computed: {

           btnText(){
                return (this.status) ? 'Unfollow' : 'Follow';
           }

        }
    }
</script>
