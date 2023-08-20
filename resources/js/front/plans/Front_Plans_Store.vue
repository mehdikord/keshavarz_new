<script>
import Front_Plans_Customers from "./Front_Plans_Customers.vue";
import Front_Plans_Providers from "@/front/plans/Front_Plans_Providers.vue";

export default {
    name: "Front_Plans_Store",
    components:{
        'customer_plans' : Front_Plans_Customers,
        'provider_plans' : Front_Plans_Providers,

    },
    data(){
        return{
            plan_select:'customer'
        }
    }
}
</script>

<template>
    <div class="row justify-center">
        <div class="col-lg-9 col-sm-12 col-xs-12 ">
            <div class="q-mt-md">
                <q-img class="search-img" src="/front/images/membership.png"></q-img>
                <strong class="text-green-7 title q-ml-sm">
                    خرید اشتراک ویژه کشاورز
                </strong>
                <p class="text-justify q-mt-md">
                    کاربر گرامی شما میتوانید با خرید اشتراک مورد نظر خود (دریافت خدمات و ارائه خدمات) از امکانات کامل اپلیکشن کشاورز بدون محدودیت استفاده کنید
                </p>
            </div>
            <hr>
            <div class="row">
                <div class="col-12">
                    <q-banner dense class="bg-teal-8 text-white reserve-text">
                        <q-icon name="fas fa-info-circle"/>
                        چنانچه اشتراک فعالی داشته باشید ، اشتراک جدید خریداری شده به صورت <strong> رزرو </strong> برای شما ثبت و به صورت خودکار اعمال میشود.
                    </q-banner>
                </div>
                <div class="col-12 text-center q-mt-md select-text">
                    نوع اشتراک مورد نیاز را انتخاب کنید
                </div>
                <div class="col-12 q-mt-md row justify-center">
                    <div class="col-xl-4 col-lg-4 col-md-5 col-sm-12 col-xs-12  select-padding">
                        <q-card class="cursor-pointer" @click="plan_select='customer'"  :class="{'bg-green-8 text-white shadow-8' : plan_select==='customer'}">
                            <q-card-section>
                                <q-icon name="fab fa-pagelines fa-2x" />
                                <strong class="select-title">اشتراک های دریافت خدمات</strong>
                            </q-card-section>
                        </q-card>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-5 col-sm-12 col-xs-12 select-padding">
                        <q-card class="cursor-pointer" @click="plan_select='provider'"  :class="{'bg-green-8 text-white shadow-8' : plan_select==='provider'}">
                            <q-card-section>
                                <q-icon name="fas fa-tractor fa-2x" />
                                <strong class="select-title">اشتراک های ارائه خدمات</strong>
                            </q-card-section>
                        </q-card>
                    </div>
                    <div class="col-xl-8 col-lg-8 col-md-10 col-sm-12 col-xs-12 q-mt-md">
                        <q-separator/>
                    </div>
                </div>
            </div>
            <div class="q-mt-lg">
                <q-slide-transition>
                    <customer_plans v-show="plan_select==='customer'"></customer_plans>
                </q-slide-transition>
                <q-slide-transition>
                    <provider_plans v-show="plan_select==='provider'"></provider_plans>
                </q-slide-transition>
            </div>

        </div>

    </div>



</template>

<style scoped>
.title{
    font-size: 18px;
}
.search-img{
    width: 80px;
}
.reserve-text{
    font-size: 14px;
}
.select-text{
    font-size: 17px;
    font-weight: 600;
}
.select-padding{
    padding: 0 10px;
}
.select-title{
    font-size: 15px;
    margin-left: 10px;
}
@media only screen and (max-width: 600px) {

    .title{
        font-size: 15px;
    }
    .search-img{
        width: 70px;
    }
    .reserve-text{
        font-size: 12px;
    }
    .select-text{
        font-size: 15px;
        font-weight: 600;
    }
    .select-padding{
        padding: 0 1px;
        margin-bottom: 10px;
    }
    .select-title{
        font-size: 14px;
        margin-left: 10px;
    }
}
</style>
