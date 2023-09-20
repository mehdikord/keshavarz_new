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
    <q-card>
        <template  v-if="loading_user">
            <q-card-section>
                <Global_Loading></Global_Loading>
            </q-card-section>
        </template>
        <template v-else>
            <q-card-section>
                <strong>
                    مدیریت حساب کاربری : <span class="text-red">{{user.name}}</span>
                </strong>
            </q-card-section>
        </template>

    </q-card>
</template>

<style scoped>

</style>
