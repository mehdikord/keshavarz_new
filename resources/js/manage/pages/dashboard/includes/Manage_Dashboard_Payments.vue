<script>
export default {
    name: "Manage_Dashboard_Payments" ,
    mounted() {
        this.GetItems();
    },
    data(){
        return {
            loading:true,
            items:[],
        }
    },
    methods: {
        GetItems(){
            axios.get('dashboard/payments').then(res => {
                this.items = res.data.result;
                this.loading=false;
            }).catch(error => {
                return this.NotifyServerError()
            })

        }
    }
}
</script>

<template>
    <q-card>
        <q-card-section class="bg-grey-2">
            <div class="text-indigo">
                <strong class="font-18">
                    اطلاعات کلی فروش سیستم
                </strong>
            </div>
            <div class="q-mt-xl q-mb-md row">
                <div class="col-md-4 text-center">
                    <Global_Loading v-if="loading"></Global_Loading>
                    <template v-else>
                        <strong class="font-16 text-grey-9">
                            کل فروش از اشتراک خدمات دهنده
                        </strong>
                        <div class="q-mt-md">
                            <strong class="font-24 text-green-8">
                                {{this.$filters.numbers(items.providers)}}
                            </strong>
                        </div>
                    </template>

                </div>
                <div class="col-md-4 text-center">
                    <Global_Loading v-if="loading"></Global_Loading>
                    <template v-else>
                        <strong class="font-16 text-grey-9">
                            کل فروش از اشتراک خدمات گیرنده
                        </strong>
                        <div class="q-mt-md">
                            <strong class="font-24 text-green-8">
                                {{this.$filters.numbers(items.customers)}}
                            </strong>
                        </div>
                    </template>

                </div>
                <div class="col-md-4 text-center">
                    <Global_Loading v-if="loading"></Global_Loading>
                    <template v-else>
                        <strong class="font-16 text-grey-9">
                            کل فروش از فروشگاه محصولات
                        </strong>
                        <div class="q-mt-md">
                            <strong class="font-24 text-green-8">
                                {{this.$filters.numbers(items.shop)}}
                            </strong>
                        </div>
                    </template>

                </div>
            </div>
        </q-card-section>
    </q-card>
</template>

<style scoped>

</style>
