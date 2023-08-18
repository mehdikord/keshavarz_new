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
                <q-card-section>
                    <div class="plan-title text-deep-orange-9 text-center">
                        اشتراک دریافت خدمات
                    </div>
                    <div class="q-mt-md row justify-center">
                        <div class="col-xl-7 col-lg-8 col-md-10 col-sm-12 col-xs-12">
                            <global_info_loading v-if="customer_active_loading"/>
                            <template v-else>
                                <q-card class="bg-grey-7">
                                    <q-card-section>
                                        adada
                                    </q-card-section>
                                </q-card>

                                <q-separator class="q-mt-md q-mb-sm"/>
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
.buy-btn{
    font-size: 14px;
    font-weight: 650;
}

@media only screen and (max-width: 600px) {

    .head-title{
        font-size: 14px;
        font-weight: 600;
        text-align: center;
    }
    .plan-title{
        font-size: 14px;
        font-weight: 450;
    }
    .not-active{
        font-size: 12px;
        font-weight: 400;
    }
    .buy-btn{
        font-size: 13px;
        font-weight: 600;
    }

}


</style>
