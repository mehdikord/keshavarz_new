
<template>

    <div class="container ">
        <div class="mt-5">
            <profile_auth></profile_auth>
        </div>


    </div>
</template>

<style scoped>

</style>
<script>
import {defineComponent} from 'vue'
import Front_Profile_Auth from "./includes/Front_Profile_Auth.vue";

export default defineComponent({
    name: "Front_Profile_Index",
    components:{
        'profile_auth' : Front_Profile_Auth,
    }
})
</script>
