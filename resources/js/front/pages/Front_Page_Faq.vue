<script>
export default {
    name: "Front_Page_Faq",
    mounted() {
        this.GetFaqs();
    },
    data(){
        return{
            loading:true,
            faqs:[],
        }
    },
    methods:{
        GetFaqs(){
            axios.get('public/faqs').then(res => {
                this.faqs = res.data.result;
                this.loading=false;
            }).catch(error => {
                this.NotifyServerError();
            })
        }
    }
}
</script>

<template>
    <div class="row justify-center">
        <div class="col-lg-9 col-sm-12 col-xs-12 ">
            <div class="q-mt-md">
                <strong class="text-green-7 title q-ml-sm">
                    سوالات متداول کاربران
                </strong>
                <q-separator class="q-mt-md"/>
            </div>
            <div class="q-mt-lg">
                <p class="faq-info text-grey-9 text-justify">
                    اگر پاسخ خود را در این صفحه نیافتید، میتوانید با تماس با پشتیبانی یا ارسال پیام به تیم کشاورز سوال خود را مطرح کنید
                    تیم پشتیبانی کشاورز کاملا پاسخوگو سوالات شما خواهد بود
                </p>
            </div>
            <div class="q-mt-lg">
                <global_info_loading class="q-mt-lg" v-if="loading"></global_info_loading>
                <div v-else class="row">
                    <div v-for="faq in faqs" class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 q-mb-lg">
                        <q-expansion-item
                            class="shadow-6 overflow-hidden"
                            style="border-radius: 8px"
                            header-class="bg-indigo-7 text-white"
                            expand-icon-class="text-white"
                        >
                            <template v-slot:header class="for-padding">
                                <div class="faq-box">
                                    {{faq.question}}
                                </div>
                            </template>
                            <q-card>
                                <q-card-section>
                                 <p class="text-justify faq-text">
                                     {{faq.answer}}
                                 </p>
                                </q-card-section>
                            </q-card>
                        </q-expansion-item>
                    </div>
                </div>

            </div>



            <div class=" text-center">
                <q-img class="ab-image" src="/front/images/services-bg.svg"></q-img>
            </div>


        </div>
    </div>

</template>

<style scoped>
.title{
    font-size: 22px;
}
.ab-image{
    width: 50%;
}
.faq-info{
    font-size: 17px;
}
.faq-box{
    width: 100%;
    padding-top: 5px;
    font-size: 15px;
}
.faq-text{
    font-size: 14px;
}
@media only screen and (max-width: 600px) {
    .title {
        font-size: 18px;
    }
    .ab-image{
        width: 100%;
    }
    .faq-info{
        font-size: 15px;
    }
    .faq-box{
        width: 100%;
        padding-top: 5px;
        font-size: 14px;
    }
    .faq-text{
        font-size: 13px;
    }


}
</style>
