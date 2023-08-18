<script>
export default {
    name: "Front_Profile_Plans"
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
                    <template v-if="false">
                        <global_info_loading></global_info_loading>
                    </template>
                    <div v-else class="row">
                        <div class="plan-title text-deep-orange-9">
                            اشتراک دریافت خدمات :
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
    font-size: 14px;
    font-weight: 500;
}

@media only screen and (max-width: 600px) {

    .head-title{
        font-size: 14px;
        font-weight: 600;
        text-align: center;
    }
    .plan-title{
        font-size: 13px;
        font-weight: 450;
    }



}


</style>
