<template>
    <button class="btn btn-default" v-bind:class="{'btn-success':followed}" v-text="text" @click="follow">

    </button>
</template>

<script>
    export default {
        props: [ 'user', 'question'],
        mounted() {
            axios.post('/api/question/follower', {question:this.question,user:this.user}).then(res => {
                console.log(res.data)
                this.followed = res.data.followed
            })
        },
        data(){
            return {
                followed:false
            }
        },
        computed:{
            text(){
                return this.followed?'已关注':'关注该问题'
            }
        },
        methods:{
            follow(){
                axios.post('/api/question/follow', {question:this.question,user:this.user}).then(res => {
                    console.log(res.data)
                    this.followed = res.data.followed
                })
            }
        }
    }
</script>
