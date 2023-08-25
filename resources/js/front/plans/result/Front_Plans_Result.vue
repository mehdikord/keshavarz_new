<script>
export default {
    name: "Front_Plans_Result",
    mounted() {
        if (this.$route.query && this.$route.query.type){
            if (this.$route.query.type === 'success'){
                this.result='success';
            }else {
                this.result='failed';
            }
        }
    },
    data(){
        return{
            result:''
        }
    },


}
</script>

<template>
    <div class="row justify-center">
        <div class="col-xl-5 div-lg-6 div-md-7 div-sm-12 div-xs-12">

            <q-card v-if="result==='success'">
                <q-card-section class="bg-green-8 text-center text-white">
                    <strong class="title">پرداخت باموفقیت انجام شد</strong>
                </q-card-section>
                <q-card-section>
                    <div class="text-center q-mt-lg">
                        <q-img src="/front/images/payment-success.png" class="image"></q-img>
                        <div class="q-mt-md info">
                            کاربر گرامی پرداخت شما باموفقیت انجام شد و اشتراک مورد نظر فعال گردید
                            <br>
                            با تشکر از شما برای انتخاب ما !
                        </div>
                        <div class="text-box font-iransans text-green-7">
                            کشاورز همراه همیشگی کشاورزان
                        </div>
                    </div>
                </q-card-section>
            </q-card>
            <q-card v-else>
                <q-card-section class="bg-red text-center text-white">
                    <strong class="title">پرداخت ناموفق بود</strong>
                </q-card-section>
                <q-card-section>
                    <div class="text-center q-mt-lg">
                        <q-img src="/front/images/payment-failed.png" class="image"></q-img>
                        <div class="q-mt-md info">
                            کاربر گرامی پرداخت شما موفقیت آمیز نبود ، لطفا عملیات مورد نظر را دوباره انجام دهید
                            <br>
                            و در صورت وجود مشکل با پشتیبانی تماس بگیرید
                        </div>
                        <div class="text-box font-iransans text-green-7">
                            کشاورز همراه همیشگی کشاورزان
                        </div>
                    </div>
                </q-card-section>
            </q-card>

        </div>

    </div>
</template>

<style scoped>
.title{
    font-size: 16px;
}
.image{
    width: 120px;
}
.info{
    font-size: 14px;
    font-weight: 500;
}
.text-box{
    margin-top: 140px;
    font-size: 20px;
    font-weight: 600;

}
@media only screen and (max-width: 600px) {
    .title{
        font-size: 14px;
    }
    .image{
        width: 90px;
    }
    .info{
        font-size: 13px;
        font-weight: 500;
    }
    .text-box{
        margin-top: 80px;
        font-size: 16px;
        font-weight: 600;

    }
}

</style>
