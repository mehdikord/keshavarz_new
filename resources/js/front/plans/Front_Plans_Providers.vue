<script>
import { useQuasar, QSpinnerGears } from 'quasar'
import Front_Skeleton_Plans from "../skeleton/Front_Skeleton_Plans.vue";
import {mapActions} from "vuex";
import Front_Plans_Item from "./Front_Plans_Item.vue";

export default {
    name: "Front_Plans_Providers",
    mounted() {
        this.GetPlans();
    },
    data(){
        return{
            plans:[],
            loading:false,
            pay_loading:false,
            BuyDialog:[]
        }
    },
    methods:{
        ...mapActions([
            "PlansStoreIndexProvider",
        ]),
        GetPlans(){
            this.loading=true;
            this.PlansStoreIndexProvider().then(res => {
                this.loading=false;
                this.plans = res.data.result;
            }).catch(error => {
                this.loading=false;
                return this.NotifyServerError();

            })
        },
        BuyPlan(plan){
         this.pay_loading=true;
         axios.get('users/plans/provider/buy/'+plan.id).then(res => {
             if (res.data.result){
                 window.open(res.data.result,'_blank');
             }
             this.pay_loading=false;
         }).catch(e => {
             this.pay_loading=false;
             console.log(e.response)
         })
        }

    },
    components:{
        'skeleton' : Front_Skeleton_Plans,
        'plan_item' : Front_Plans_Item,
    }
}
</script>

<template>
    <div class="row">

        <div v-if="loading" v-for="i in 4" class="box-padding col-xl-3 col-lg-4 col-md-6 col-sm-12 col-xs-12">
            <skeleton/>
        </div>

        <div v-else v-for="plan in plans" class="box-padding col-xl-3 col-lg-4 col-md-6 col-sm-12 col-xs-12">
            <plan_item @click="BuyDialog[plan.id] = true" :item="plan"/>
            <q-dialog position="top" v-model="BuyDialog[plan.id]">
                <q-card class="buy-card">
                    <q-card-section class="text-center invoice-header bg-green-7 text-white">
                        خرید {{plan.title}}
                    </q-card-section>
                    <q-card-section class="q-px-xs">
                        <template v-if="this.AuthUserCheck()">
                            <q-banner class="bg-teal-10 text-white" rounded>
                                <q-icon name="fas fa-info-circle fa-2x q-mr-sm"></q-icon>
                                <span class="invoice-text">
                                کاربر گرامی بعد از خرید اشتراک ، خدمات اپلیکیشن کشاورز بلافاصله برای شما به صورت خودکار فعال میشود .
                            </span>
                            </q-banner>
                            <div class="q-mt-md">
                                <div class="invoice-info-title text-red text-center">
                                    اطلاعات پرداخت
                                </div>
                                <q-separator class="q-mt-sm"/>
                                <div class="q-mt-sm row justify-center">
                                    <div class="col-lg-7 text-center row">
                                        <div class="col-6">
                                            <span>عنوان محصول : </span>
                                        </div>
                                        <div class="col-6">
                                        <span class="text-green-8">
                                            {{plan.title}}
                                        </span>
                                        </div>
                                        <div class="col-12 q-mt-md q-mb-md">
                                            <q-separator/>
                                        </div>
                                        <div class="col-6">
                                            <span>نوع پرداخت : </span>
                                        </div>
                                        <div class="col-6">
                                        <span class="text-green-8">
                                            پرداخت آنلاین شبکه شتاب
                                        </span>
                                        </div>
                                        <div class="col-12 q-mt-md q-mb-md">
                                            <q-separator/>
                                        </div>
                                        <div class="col-6">
                                            <span>پذیرنده : </span>
                                        </div>
                                        <div class="col-6">
                                        <span class="text-green-8">
                                            شرکت کیانمهر
                                        </span>
                                        </div>
                                        <div class="col-12 q-mt-md q-mb-md">
                                            <q-separator/>
                                        </div>
                                        <div class="col-6">
                                            <span>مبلغ قابل پرداخت : </span>
                                        </div>
                                        <div class="col-6">
                                            <template v-if="plan.is_free">
                                                <strong class="text-green-8">
                                                    رایگان
                                                </strong>
                                            </template>
                                            <template v-else>
                                                <strong v-if="plan.sale" class="text-indigo">
                                                    {{this.$filters.numbers(plan.sale)}}
                                                </strong>
                                                <strong v-else class="text-indigo">
                                                    {{this.$filters.numbers(plan.price)}}
                                                </strong>
                                                <span class="q-ml-sm">تومان</span>
                                            </template>

                                        </div>
                                        <div class="col-12 q-mt-md q-mb-md">
                                            <q-separator/>
                                        </div>
                                        <div class="col-12">
                                            <q-img src="/logo_name.png" class="invoice-img"></q-img>
                                        </div>
                                        <div class="col-12 q-mt-md q-mb-md text-center">
                                            <q-btn @click="BuyPlan(plan)" color="green-7" glossy>پرداخت نهایی و فعالسازی</q-btn>

                                            <q-dialog v-model="pay_loading" persistent transition-show="scale" transition-hide="scale">
                                                <q-card class="bg-grey-10 text-white" style="width: 650px">
                                                    <q-card-section>
                                                        <global_info_loading></global_info_loading>
                                                        <div class="q-mt-md q-mb-md text-center">
                                                            <strong class="text-green-5">لطفا شکیبا باشید ، درحال اتصال به درگاه پرداخت ...</strong>
                                                        </div>
                                                    </q-card-section>
                                                </q-card>
                                            </q-dialog>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </template>
                        <template v-else>
                            <q-banner class="bg-red text-center text-white">
                                <span>کاربر گرامی برای خرید و فعالسازی اشتراک ابتدا باید وارد حساب کاربری خود شوید</span>
                            </q-banner>
                            <div class="q-mt-lg q-mb-md text-center">
                                <q-btn :to="{name : 'profile'}" color="indigo" glossy>ثبت نام / ورود به حساب کاربری</q-btn>
                            </div>
                        </template>


                    </q-card-section>
                </q-card>
            </q-dialog>
        </div>

    </div>
</template>

<style scoped>
.box-padding{
    padding: 0 5px;
    margin-bottom: 15px;
}
.buy-card{
    max-width: 900px;
    width: 860px;
}
.invoice-header{
    font-size: 16px;
    font-weight: 600;
}
.invoice-text{
    font-size: 14px;
}
.invoice-info-title{
    font-size: 16px;
    font-weight: 600;
}
.invoice-img{
    width: 110px;
}

@media only screen and (max-width: 600px) {
    .box-padding{
        padding: 0 5px;
        margin-bottom: 15px;
    }
    .buy-card{
        max-width: 900px;
        width: 860px;
    }
    .invoice-header{
        font-size: 14px;
        font-weight: 600;
    }
    .invoice-text{
        font-size: 12px;
    }
    .invoice-img{
        width: 70px;
    }

}
</style>
