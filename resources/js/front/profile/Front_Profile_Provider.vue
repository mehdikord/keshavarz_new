<script>
import {mapActions} from "vuex";
import Front_Profile_Provider_Request_Waiting_Item
    from "./provider/requests/Front_Profile_Provider_Request_Waiting_Item.vue";

export default {
    name: "Front_Profile_Provider",
    components : {
        'request_waiting_item' : Front_Profile_Provider_Request_Waiting_Item,
    },
    mounted() {
        if (this.AuthUserCheck()){
            this.GetNewRequests();
        }

    },
    data(){
        return{
            new_requests_loading:true,
            new_requests:[],

        }
    },
    methods:{
        ...mapActions([
            "UserProviderPending"
        ]),

        GetNewRequests(){
            this.UserProviderPending().then(res => {
                this.new_requests = res.data.result;
                this.new_requests_loading=false
            })

        },
        AcceptNewRequest(){
            this.GetNewRequests();
            this.NotifySuccess("درخواست مورد نظر پذیرفته و اطلاعات تماس شما برای درخواست دهنده ارسال گردید");
        }

    },
    computed :{

    }
}
</script>

<template>
    <div class="row justify-center">
        <div class="col-lg-9 col-sm-12 col-xs-12 ">
            <div class="q-mt-md">
                <q-img class="search-img" src="/front/images/tractor_provider.png"></q-img>
                <strong class="text-green-7 title q-ml-sm">
                    ارائه خدمات کشاورزی
                </strong>
                <p class="text-justify q-mt-md subtitle text-indigo">
                    کاربر گرامی شما در این صفحه میتوانید اطلاعات خود را مربوط ارائه خدمات کشاورزی تکمیل کنید تا کشاورزانی که به دنبال خدمات کشاورزی مرتبط با شما هستند اطلاعات تماس شما را دریافت کنند.
                </p>
            </div>
            <div class="q-mt-lg">
                <template v-if="!this.AuthUserCheck()">
                    <q-banner rounded class="bg-orange-9 text-center">
                        <strong class="auth-text text-white">
                            کاربر گرامی برای تکمیل اطلاعات مربوط به ارائه خدمات خود ، ابتدا باید وارد حساب کاربری خود شوید
                        </strong>
                        <div class="q-mt-lg q-pb-md">
                            <q-btn :to="{name:'profile'}" color="white" glossy text-color="dark" class="auth-btn">ثبت نام / ورود به حساب</q-btn>
                        </div>
                    </q-banner>
                </template>
                <template v-else>
                    <div class="q-mt-md q-mb-sm">
                            <div class="row">
                                <div class="col-md-3 col-sm-6 col-xs-6 q-px-xs q-mt-sm ">
                                    <router-link :to="{name : 'profile_provider_range'}">
                                        <q-card class="menu-bg pointer shadow-12">
                                            <q-card-section>
                                                <q-img src="/front/images/map.png" class="menu-img" />
                                                <strong class="text-white q-ml-sm menu-title">محدوده فعالیت</strong>
                                            </q-card-section>
                                        </q-card>
                                    </router-link>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-6 q-px-xs q-mt-sm">
                                    <router-link :to="{name : 'profile_provider_implements'}">
                                        <q-card class="menu-bg pointer shadow-12">
                                            <q-card-section>
                                                <q-img src="/front/images/tractor.png" class="menu-img" />
                                                <strong class="text-white q-ml-sm menu-title">ادوات قابل ارائه</strong>
                                            </q-card-section>
                                        </q-card>
                                    </router-link>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-6 q-px-xs q-mt-sm">
                                    <router-link :to="{name : 'profile_provider_days'}" >
                                        <q-card class="menu-bg pointer shadow-12">
                                            <q-card-section>
                                                <q-img src="/front/images/sleep.png" class="menu-img" />
                                                <strong class="text-white q-ml-sm menu-title">روز های تعطیل</strong>
                                            </q-card-section>
                                        </q-card>
                                    </router-link>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-6 q-px-xs q-mt-sm">
                                    <router-link :to="{name : 'profile_provider_gallery'}">
                                        <q-card class="menu-bg pointer shadow-12">
                                            <q-card-section>
                                                <q-img src="/front/images/gallery.png" class="menu-img" />
                                                <strong class="text-white q-ml-sm menu-title">گالری تصاویر شما</strong>
                                            </q-card-section>
                                        </q-card>
                                    </router-link>

                                </div>
                            </div>
                        </div>
                    <div class="q-mt-md">
                        <q-card class="shadow-4">
                            <q-card-section class="mobile-padding">
                                <div class="text-center">
                                    <strong class="text-red req-title">درخواست های در انتظار تایید</strong>
                                    <q-icon name="fas fa-question-circle q-ml-sm font-20" class="text-indigo cursor-pointer">
                                        <q-popup-proxy :offset="[90,10]">
                                            <q-banner class="bg-indigo-6 text-white">
                                                در صورت وجود درخواست شما میتوانید با استفاده از دکمه پذیرفتن، درخواست را قبول کرده و اطلاعات تماس شما برای درخواست کننده ارسال شود. توجه داشته باشید ممکن است درخواست ها برای خدمات دهندگان دیگر نیز ارسال شود و درصورت پذیرفتن سریع تر کاربر دیگر این درخواست از لیست شما حذف میگردد
                                            </q-banner>
                                        </q-popup-proxy>
                                    </q-icon>
                                </div>
                                <global_info_loading v-if="new_requests_loading"></global_info_loading>
                                <template v-else>
                                    <div v-if="!new_requests.length" class="text-center q-mt-xs">
                                        <q-img src="/front/images/empty.png" class="req-img-empty" />
                                        <div class="q-mt-xs text-grey-8">
                                            درخواست جدیدی وجود ندارد
                                        </div>
                                    </div>
                                    <div v-else class="row justify-center q-mt-lg">
                                        <div v-for="request in new_requests" class="col-md-4 col-sm-6 col-xs-12 q-px-sm q-mb-md">
                                            <request_waiting_item @AcceptRequest="AcceptNewRequest" :request="request"></request_waiting_item>
                                        </div>
                                    </div>
                                </template>


                            </q-card-section>
                        </q-card>
                    </div>
                    <div class="q-mt-md">
                        <q-card class="shadow-4">
                            <q-card-section class="mobile-padding">
                                <div class="text-center">
                                    <strong class=" req-title">درخواست های تایید شده</strong>
                                    <q-icon name="fas fa-question-circle q-ml-sm font-20" class="text-indigo cursor-pointer">
                                        <q-popup-proxy :offset="[90,10]">
                                            <q-banner class="bg-indigo-6 text-white">

                                            </q-banner>
                                        </q-popup-proxy>
                                    </q-icon>
                                </div>
                                <global_info_loading v-if="new_requests_loading"></global_info_loading>
                                <template v-else>
                                    <div v-if="!new_requests.length" class="text-center q-mt-xs">
                                        <q-img src="/front/images/empty.png" class="req-img-empty" />
                                        <div class="q-mt-xs text-grey-8">
                                            درخواست جدیدی وجود ندارد
                                        </div>
                                    </div>
                                    <div v-else class="row justify-center q-mt-lg">
                                        <div v-for="request in new_requests" class="col-md-4 col-sm-6 col-xs-12 q-px-sm q-mb-md">
                                            <request_waiting_item @AcceptRequest="AcceptNewRequest" :request="request"></request_waiting_item>
                                        </div>
                                    </div>
                                </template>


                            </q-card-section>
                        </q-card>
                    </div>

                </template>
            </div>
        </div>
    </div>
</template>

<style scoped>
.menu-img{
    width: 75px;
}
.menu-bg{
    background-color: #011133;
}
.title{
    font-size: 18px;
}
.subtitle{
    font-size: 15px;
}
.search-img{
    width: 80px;
}
.auth-text{
    font-size: 14px;
}
.auth-btn{
    font-size: 14px;
}
.req-title{
    font-size: 15px;
}
.req-img-empty{
    width: 60px;
}


@media only screen and (max-width: 600px) {
    .mobile-padding{
        padding-left: 1px;
        padding-right: 1px;
    }
    .menu-img{
        width: 40px;
    }
    .menu-title{
        font-size: 13px;
    }
    .title{
        font-size: 15px;
    }
    .subtitle{
        font-size: 13px;
    }
    .search-img{
        width: 70px;
    }
    .auth-text{
        font-size: 13px;
    }
    .auth-btn{
        font-size: 13px;
    }
    .req-title{
        font-size: 13px;
    }

}
</style>
