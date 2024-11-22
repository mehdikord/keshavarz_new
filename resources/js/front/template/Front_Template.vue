<template>

    <q-layout view="hHh lpR fFf">

        <Front_Template_Header/>

        <q-page-container>
            <q-page padding>
                <router-view />
            </q-page>
        </q-page-container>

        <Front_Template_Footer/>
        <q-dialog v-model="app_dialog" position="standard">
            <q-card style="width: 100%!important;">
                <q-card-section>
                    <div class="text-center">
                        <strong class="text-green-6 font-iransans font-17">نصب اپلیکیشن کشاورز در موبایل</strong>
                        <div class="q-mt-sm font-13 text-grey-8 ">
                            <strong>برای دسترسی سریعتر و کارایی بهتر اپلیکیشن کشاورز را در موبایل خود نصب کنید</strong>
                        </div>
                        <div class="q-mt-lg row">
                            <div class="col-6 q-pa-sm">
                                <q-btn style="width: 100%" color="green-8" glossy class="font-16 " label="نصب کشاورز"></q-btn>

                            </div>
                            <div class="col-6 q-pa-sm">
                                <q-btn style="width: 100%" color="grey-8" glossy class="font-16 " label="بستن"></q-btn>

                            </div>
                        </div>
                    </div>
                </q-card-section>

            </q-card>
        </q-dialog>





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

    },
    data(){
        return{
            app_dialog:false,
        }
    }


})
</script>
