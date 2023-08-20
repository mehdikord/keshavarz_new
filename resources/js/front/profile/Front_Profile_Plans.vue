<script>
import {mapActions} from "vuex";

export default {
    name: "Front_Profile_Plans",
    mounted() {
        this.Get_Customer_Active();
    },
    data(){
        return {
            customer_active_loading:false,
            customer_active:null,
            provider_active_loading:false,
            provider_active:null,
        }
    },
    methods :{
        ...mapActions([
            "UserPlanCustomerActive"
        ]),
        Get_Customer_Active(){
            this.customer_active_loading=true;
            this.UserPlanCustomerActive().then(res => {
                this.customer_active = res.data.result;
                this.customer_active_loading=false;
            }).catch(error => {
                this.customer_active_loading=false;
                return this.NotifyServerError();
            })
        }

    }
}
</script>

<template>
    <div class="row justify-center">
        <div class="col-xl-8 col-lg-8 col-md-10 col-sm-12 col-xs-12">
            <q-card>
                <q-card-section class="bg-green-6">
                    <div class="head-title text-white">اشتراک های فعال</div>
                </q-card-section>
                <q-card-section class="mobile-plan-card-top">
                    <div class="plan-title text-indigo text-center">
                        اشتراک دریافت خدمات
                    </div>
                    <div v-if="!customer_active_loading && !customer_active" class="text-center q-mt-sm not-active text-red-7">
                        <q-icon name="fas fa-bell fa-beat" />
                        اشتراکی برای دریافت خدمات برای شما فعال نیست
                    </div>
                    <div class="q-mt-md row justify-center">
                        <div class="col-xl-5 col-lg-6 col-md-7 col-sm-12 col-xs-12">
                            <global_info_loading v-if="customer_active_loading"/>
                            <template v-else>
                                <q-card class="bg-positive text-white" v-if="customer_active">
                                    <q-card-section>
                                        <q-icon class="card-active-icon" name="fas fa-check-circle fa-beat"/>
                                    </q-card-section>
                                </q-card>
                                <q-card v-else class="bg-teal-7 shadow-8 cursor-pointer">
                                    <router-link :to="{name : 'plans'}">
                                        <q-card-section class="mobile-plan-card">
                                            <div class="row">
                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 text-center">
                                                    <q-img src="/front/images/tractor.png" class="buy-img" />
                                                </div>
                                                <div class="col-lg-9 col-md-3 col-sm-9 col-xs-9 q-pl-md">
                                                    <div class="text-white buy-card-title font-iransans">
                                                        خرید اشتراک دریافت خدمات
                                                    </div>
                                                    <div class="buy-card-subtitle text-grey-3 text-justify">
                                                        با خرید اشتراک دریافت خدمات کشاورز ، از امکانات کامل سیستم کشاورز برای جستجو و دریافت ادوات و خدمات کشاورزی بهره‌مند شوید
                                                    </div>
                                                </div>
                                            </div>
                                        </q-card-section>
                                    </router-link>
                                </q-card>

                            </template>
                        </div>
                    </div>
                </q-card-section>
            </q-card>

        </div>

    </div>
</template>

<style scoped>
.head-title{
    font-size: 16px;
    font-weight: 700;
}
.plan-title{
    font-size: 15px;
    font-weight: 500;
}
.not-active{
    font-size: 13px;
    font-weight: 450;
}
.buy-card-title{
    font-size: 23px;
    font-weight: 800;
    margin-top: 8px;
    margin-bottom: 8px;
}
.buy-card-subtitle{
    font-size: 14px;
    font-weight: 500;
}
.buy-img{
    width: 100px;
}
.card-active-icon{
    font-size: 28px;
}

@media only screen and (max-width: 600px) {

    .mobile-plan-card{
        padding: 18px 8px;
    }
    .mobile-plan-card-top{
        padding: 15px 5px;
    }
    .head-title{
        font-size: 16px;
        font-weight: 600;
        text-align: center;
    }
    .plan-title{
        font-size: 14px;
        font-weight: 450;
    }
    .not-active{
        font-size: 13px;
        font-weight: 500;
    }

    .buy-card-title{
        font-size: 19px;
        font-weight: 750;
        margin-top: 8px;
        margin-bottom: 8px;
    }
    .buy-card-subtitle{
        font-size: 13px;
        font-weight: 450;
    }
    .buy-img{
        width: 85px;
    }
    .card-active-icon{
        font-size: 19px;
    }
}


</style>
