<script>
import {mapActions} from "vuex";

export default {
    name: "Manage_Users_Members_Details",
    props:['data'],
    data(){
        return{
            loading_user:true,
            user:null
        }

    },
    methods:{
        ...mapActions([
            "UserMembersEdit",

        ]),


    },
    computed:{


    }
}
</script>

<template>

</template>

<style scoped>

</style>
