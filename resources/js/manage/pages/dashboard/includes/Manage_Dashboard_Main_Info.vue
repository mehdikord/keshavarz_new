<script>
export default {
    name: "Manage_Dashboard_Main_Info",
    mounted() {
      this.GetItems();
    },
    data(){
        return{
            loading:true,
            items:[],
        }
    },
    methods : {
        GetItems(){
            axios.get('dashboard/main/info').then(res => {
                this.items = res.data.result;
                this.loading=false;
            }).catch(error => {
                this.NotifyServerError();
            })
        },
    }
}
</script>

<template>

    <div v-if="loading" class="row">
        <div v-for="i in 4" class="col-md-3 col-sm-6 col-xs-12 q-px-sm">
            <q-card>
                <q-card-section class="">
                    <div class="text-center">
                        <q-spinner-gears
                            color="indigo-10"
                            size="70px"
                        />
                        <strong class="text-center q-ml-sm">درحال بارگذاری ...</strong>
                    </div>
                </q-card-section>

            </q-card>
        </div>
    </div>

    <div v-else class="row">
        <div class="col-md-3 col-sm-6 col-xs-12 q-px-sm">
            <q-card>
                <router-link :to="{name : 'users_members'}">
                <q-card-section class="bg-teal-8 text-white">
                    <div class="q-mt-sm ">
                        <strong class="font-18">
                            تعداد کاربران سیستم
                        </strong>
                    </div>
                    <div class="q-mt-xs">تعداد کاربران ثبت نام کرده در اپلیکیشن</div>
                    <div class="text-right">
                        <strong class=" font-28">{{items.users}}</strong>
                    </div>
                </q-card-section>
                </router-link>
            </q-card>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12 q-px-sm">
            <q-card>
                <router-link :to="{name : 'users_members'}">

                <q-card-section class="bg-indigo text-white">
                    <div class="q-mt-sm ">
                        <strong class="font-18">
                            کاربران دریافت کننده خدمات
                        </strong>
                    </div>
                    <div class="q-mt-xs">تعداد کاربرانی که اشتراک فعال دریافت کننده داردند</div>
                    <div class="text-right">
                        <strong class=" font-28">{{items.customers}}</strong>
                    </div>
                </q-card-section>
                </router-link>
            </q-card>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12 q-px-sm">
            <q-card>
                <router-link :to="{name : 'users_members'}">

                <q-card-section class="bg-orange-10 text-white">
                    <div class="q-mt-sm ">
                        <strong class="font-18">
                            کاربران ارائه دهنده خدمات
                        </strong>
                    </div>
                    <div class="q-mt-xs">تعداد کاربرانی که اشتراک فعال ارائه دهنده داردند</div>
                    <div class="text-right">
                        <strong class=" font-28">{{items.providers}}</strong>
                    </div>
                </q-card-section>
                </router-link>
            </q-card>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12 q-px-sm">
            <q-card>
                <router-link :to="{name : 'searches'}">

                <q-card-section class="bg-blue-grey-14 text-white">
                    <div class="q-mt-sm ">
                        <strong class="font-18">
                            تعداد درخواست های جستجو
                        </strong>
                    </div>
                    <div class="q-mt-xs">تعداد درخواست های ارسال شده برای دریافت خدمات</div>
                    <div class="text-right">
                        <strong class=" font-28">{{items.requests}}</strong>
                    </div>
                </q-card-section>
                </router-link>
            </q-card>
        </div>
    </div>


</template>

<style scoped>

</style>
