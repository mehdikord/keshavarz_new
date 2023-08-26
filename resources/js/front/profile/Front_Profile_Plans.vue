<script>
import {mapActions} from "vuex";
import Front_Plans_Reserved_Item from "../plans/Front_Plans_Reserved_Item.vue";

export default {
    name: "Front_Profile_Plans",
    components:{
      "plan_reserved" : Front_Plans_Reserved_Item,
    },
    mounted() {
        this.Get_Customer_Active();
        this.Get_Provider_Active();
        this.Get_Customer_Reserved();
        this.Get_Provider_Reserved();
    },
    data(){
        return {
            customer_active_loading:false,
            customer_active:null,
            provider_active_loading:false,
            provider_active:null,

            customer_reserved_loading:false,
            customer_reserved:[],
            provider_reserved_loading:false,
            provider_reserved:[],
        }
    },
    methods :{
        ...mapActions([
            "UserPlanCustomerActive",
            "UserPlanProviderActive",
            "UserPlanCustomerReserved",
            "UserPlanProviderReserved",
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
        },

        Get_Provider_Active(){
            this.provider_active_loading=true;
            this.UserPlanProviderActive().then(res => {
                this.provider_active = res.data.result;
                this.provider_active_loading=false;
            }).catch(error => {
                this.provider_active_loading=false;
                return this.NotifyServerError();
            })
        },

        Get_Customer_Reserved(){
            this.customer_reserved_loading=true;
            this.UserPlanCustomerReserved().then(res => {
                this.customer_reserved = res.data.result;
                this.customer_reserved_loading=false;
            }).catch(error => {
                this.customer_reserved_loading=false;
                return this.NotifyServerError();
            })
        },

        Get_Provider_Reserved(){
            this.provider_reserved_loading=true;
            this.UserPlanProviderReserved().then(res => {
                this.provider_reserved = res.data.result;
                this.provider_reserved_loading=false;
            }).catch(error => {
                this.provider_reserved_loading=false;
                return this.NotifyServerError();
            })
        },


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
                    <div class="q-mb-md text-center">
                        <q-btn :to="{name:'plans'}" glossy color="green-9">خرید اشتراک جدید</q-btn>
                    </div>
                    <q-separator/>
                    <div class="plan-title text-indigo text-center q-mt-sm">
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
                                <q-card class="bg-dark text-white" v-if="customer_active">
                                    <q-card-section class="row items-center">
                                        <div class="col-xl-9 col-lg-9 col-md-9 col-sm-8 col-xs-8">
                                            <q-icon class="card-active-icon text-positive" name="fas fa-check-circle fa-beat"/>
                                            <strong class="q-ml-md active-title">{{customer_active.title}}</strong>
                                            <div class="q-mt-sm">
                                                <span class="active-info-title">مدت اشتراک : </span>
                                                <strong class=" active-access text-yellow-5">{{customer_active.access}} ماه</strong>
                                            </div>
                                            <div class="q-mt-sm">
                                                <span class="active-info-title">زمان فعال سازی : </span>
                                                <strong class=" active-access text-positive">{{this.$filters.date(customer_active.start_at)}}</strong>
                                            </div>
                                            <div class="q-mt-sm">
                                                <span class="active-info-title">زمان اتمام : </span>
                                                <strong class=" active-access text-red">{{this.$filters.date(customer_active.end_at)}}</strong>
                                            </div>

                                        </div>
                                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-4 col-xs-4 text-center">
                                            <q-knob
                                                :max="MixinLeftDate(customer_active.start_at,customer_active.end_at).total"
                                                v-model="MixinLeftDate(customer_active.start_at,customer_active.end_at).left"
                                                show-value
                                                :thickness="0.3"
                                                size="80px"
                                                color="positive"
                                                track-color="white"
                                                readonly
                                            />
                                        </div>

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
                    <div class="q-mt-md">
                        <template v-if="!customer_reserved_loading">
                            <div v-if="!customer_reserved.length" class="text-center text-red no-reserved">
                                اشتراک رزرو شده ای برای شما یافت نشد
                            </div>
                            <div v-else >
                                <div class="text-center reserved-head text-teal-6">
                                    اشتراک های رزرو شده
                                </div>
                                <div class=" row q-mt-sm">

                                    <div v-for="reserved in customer_reserved" class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12 q-px-xs q-mt-md">
                                        <plan_reserved :item="reserved" />
                                    </div>

                                </div>



                            </div>
                        </template>
                    </div>

                    <div class="q-mt-md q-mb-md">
                        <q-separator/>
                    </div>

                    <div class="plan-title text-indigo text-center">
                        اشتراک ارائه خدمات
                    </div>
                    <div v-if="!provider_active_loading && !provider_active" class="text-center q-mt-sm not-active text-red-7">
                        <q-icon name="fas fa-bell fa-beat" />
                        اشتراکی برای دریافت خدمات برای شما فعال نیست
                    </div>
                    <div class="q-mt-md row justify-center">
                        <div class="col-xl-5 col-lg-6 col-md-7 col-sm-12 col-xs-12">
                            <global_info_loading v-if="provider_active_loading"/>
                            <template v-else>
                                <q-card class="bg-dark text-white" v-if="provider_active">
                                    <q-card-section class="row items-center">
                                        <div class="col-xl-9 col-lg-9 col-md-9 col-sm-8 col-xs-8">
                                            <q-icon class="card-active-icon text-positive" name="fas fa-check-circle fa-beat"/>
                                            <strong class="q-ml-md active-title">{{provider_active.title}}</strong>
                                            <div class="q-mt-sm">
                                                <span class="active-info-title">مدت اشتراک : </span>
                                                <strong class=" active-access text-yellow-5">{{provider_active.access}} ماه</strong>
                                            </div>
                                            <div class="q-mt-sm">
                                                <span class="active-info-title">زمان فعال سازی : </span>
                                                <strong class=" active-access text-positive">{{this.$filters.date(provider_active.start_at)}}</strong>
                                            </div>
                                            <div class="q-mt-sm">
                                                <span class="active-info-title">زمان اتمام : </span>
                                                <strong class=" active-access text-red">{{this.$filters.date(provider_active.end_at)}}</strong>
                                            </div>

                                        </div>
                                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-4 col-xs-4 text-center">
                                            <q-knob
                                                :max="MixinLeftDate(provider_active.start_at,provider_active.end_at).total"
                                                v-model="MixinLeftDate(provider_active.start_at,provider_active.end_at).left"
                                                show-value
                                                :thickness="0.3"
                                                size="80px"
                                                color="positive"
                                                track-color="white"
                                                readonly
                                            />
                                        </div>

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
                                                        خرید اشتراک ارائه خدمات
                                                    </div>
                                                    <div class="buy-card-subtitle text-grey-3 text-justify">
                                                        با خرید اشتراک ارائه خدمات کشاورز ، از امکانات کامل سیستم کشاورز برای ارائه ادوات و خدمات خود به کشاورزان دیگر بهره‌مند شوید
                                                    </div>
                                                </div>
                                            </div>
                                        </q-card-section>
                                    </router-link>
                                </q-card>

                            </template>
                        </div>
                    </div>
                    <div class="q-mt-md">
                        <template v-if="!provider_reserved_loading">
                            <div v-if="!provider_reserved.length" class="text-center text-red no-reserved">
                                اشتراک رزرو شده ای برای شما یافت نشد
                            </div>
                            <div v-else >
                                <div class="text-center reserved-head text-teal-6">
                                    اشتراک های رزرو شده
                                </div>
                                <div class=" row q-mt-sm">

                                    <div v-for="reserved in provider_reserved" class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12 q-px-xs q-mt-md">
                                        <plan_reserved :item="reserved" />
                                    </div>

                                </div>



                            </div>
                        </template>
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
    font-size: 17px;
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
.active-title{
    font-size: 15px;
}
.active-info-title{
    font-size: 14px;
    font-weight: 500;
}
.active-access{
    font-size: 15px;
}
.no-reserved{
    font-size: 14px;
    font-weight: 450;
}
.reserved-head{
    font-size: 16px;
    font-weight: 500;
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
        font-size: 15px;
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
    .active-title{
        font-size: 14px;
    }
    .active-info-title{
        font-size: 13px;
        font-weight: 500;
    }
    .active-access{
        font-size: 14px;
    }
}


</style>
