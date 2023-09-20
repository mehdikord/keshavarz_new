<script>
import {mapActions} from "vuex";

export default {
    name: "Manage_Users_Members_Details",
    mounted() {
      this.GetUser();
    },
    data(){
        return{
            loading_user:true,
            user:null
        }
    },
    methods:{
        ...mapActions([
            "UserMembersShow"
        ]),
        GetUser(){
            this.UserMembersShow(this.$route.params.id).then(res =>{
                this.user = res.data.result;
                this.loading_user=false;
            }).catch(error =>{
                return this.NotifyServerError();
            })
        }


    },

}
</script>

<template>

</template>

<style scoped>

</style>
