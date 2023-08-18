<script>
import Front_Profile_Auth from "./Front_Profile_Auth.vue";
import {mapGetters,mapActions} from "vuex";
import Front_Profile_Info from "./Front_Profile_Info.vue";
import Front_Profile_Plans from "./Front_Profile_Plans.vue";

export default {
name: "Front_Profile",
    components : {
        'profile_auth' : Front_Profile_Auth,
        'profile_info' : Front_Profile_Info,
        'profile_plans' : Front_Profile_Plans,
    },
}
</script>

<template>
    <profile_auth v-if="!this.AuthUserCheck()"></profile_auth>
    <template  v-else>
        <profile_info />
        <profile_plans class="q-mt-md" />
    </template>


</template>

<style scoped>



</style>
