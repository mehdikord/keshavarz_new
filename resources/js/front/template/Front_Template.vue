<template>

    <q-layout view="hHh lpR fFf">

        <Front_Template_Header/>

        <q-page-container>
            <router-view />
        </q-page-container>

        <Front_Template_Footer/>
    </q-layout>

</template>

<style scoped>

</style>
<script>
import {defineComponent} from 'vue'
import Front_Template_Header from "@/front/template/Front_Template_Header.vue";
import Front_Template_Footer from "@/front/template/Front_Template_Footer.vue";


export default defineComponent({
    name: "Front_Template",
    components :{
        Front_Template_Footer,
        Front_Template_Header

    }


})
</script>
