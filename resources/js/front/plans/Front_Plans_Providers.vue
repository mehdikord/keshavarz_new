<script>
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
                                <div class="col-lg-7">

                                </div>
                            </div>
                        </div>
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

}
</style>
