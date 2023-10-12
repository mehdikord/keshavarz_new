<script>
import {mapActions} from "vuex";

export default {
    name: "Front_Profile_Provider_Days",
    mounted() {
        if (this.AuthUserCheck()){
            this.GetUserDays();
        }
    },
    data(){
        return{
            user_days_loading:true,
            user_days_add_loading:false,
            errors:[],
            days:[],
            date:[],

        }
    },
    methods:{
        ...mapActions([
            "ProfilesUserDays",
            "ProfilesUserDaysStore",
            "ProfilesUserDaysDelete"
        ]),
        GetUserDays(){
            this.ProfilesUserDays().then(res => {
                this.days = res.data.result;
                this.user_days_loading=false;
            }).catch(error => {
                return this.NotifyServerError();
            })

        },
        AddDays(){
            if (!this.date.length){
                return this.NotifyError('ابتدا تاریخ های مورد نظر را انتخاب کنید')
            }
            this.user_days_add_loading=true;
            this.ProfilesUserDaysStore({days:this.date}).then(res => {
                this.GetUserDays();
                this.date=[];
                this.NotifySuccess('تاریخ های مورد نظر باموفقیت اضافه شد');
                this.user_days_add_loading=false;
            }).catch(error => {
                return this.NotifyServerError();
            })
        },
        DeleteDays(id){
            this.ProfilesUserDaysDelete(id).then(res => {
                this.GetUserDays();
                this.NotifySuccess(res.data.message);
            }).catch(error => {
                return this.NotifyServerError();
            })
        }

    },



}
</script>

<template>
    <div class="row justify-center">
        <div class="col-lg-9 col-sm-12 col-xs-12">
            <div>
                <q-img class="search-img" src="/front/images/sleep.png"></q-img>
                <strong class="text-green-7 title q-ml-sm">
                    تنظیمات روز های تعطیل و غیرکاری
                </strong>
                <p class="text-justify q-mt-sm subtitle text-grey-8">
                    تاریخ های انتخابی در این قسمت بیانگر فعالیت نداشتن شما در آن روز است. یعنی اگر فردی در تاریخ های مورد نظر جستجو خدمات را انجام دهند اطلاعات شما در این روز ارائه نمیشود.
                </p>
            </div>
            <div class="text-right">
                <q-btn :to="{name : 'profile_provider'}" color="red" size="sm" class="font-12" icon-right="fas fa-arrow-left q-ml-xs" glossy >بازگشت</q-btn>
            </div>
            <global_info_loading class="q-mt-xl" v-if="user_days_loading"></global_info_loading>


            <q-card v-else class="q-mt-md">
                <q-card-section>
                    <div class="info-subtitle text-red">
                        لیست روز های تعطیل :
                    </div>
                    <div class="row justify-center q-mt-lg">
                        <div class="col-md-4 col-sm-12 col-xs-12">
                            <PersianDatePicker
                                multiple
                                v-model="date"
                                placeholder="برای انتخاب تاریخ از تقویم کلیک کنید"
                            />
                            <q-btn class="q-mt-sm" dense color="teal-7" @click="AddDays" :loading="user_days_add_loading" glossy>افرودن تاریخ جدید</q-btn>
                        </div>
                    </div>
                    <q-separator class="q-mt-md"/>
                    <div class="q-mt-sm q-mb-lg">
                        <strong class="text-teal-8">لیست روز های تعطیل شما : </strong>
                    </div>
                    <div class="mt-md q-mb-lg">
                        <global_info_loading v-if="user_days_loading"></global_info_loading>
                        <template v-else>
                            <div v-if="!days.length" class="text-center text-yellow-10">
                                <strong>
                                    هنوز هیچ تاریخی اضافه نکرده اید نشده است
                                </strong>
                            </div>
                            <div v-else class="q-mt-sm row">
                                <div v-for="day in days" class="col-md-2 q-pa-xs">
                                    <q-card>
                                        <q-card-section class="bg-deep-orange-6 text-white">
                                            <strong>{{this.$filters.date(day.day)}}</strong>
                                            <q-icon class="float-right pointer" @click="DeleteDays(day.id)" name="fas fa-trash"></q-icon>
                                        </q-card-section>
                                    </q-card>
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
.title{
    font-size: 17px;
}
.subtitle{
    font-size: 15px;
}
.search-img{
    width: 80px;
}
.info-subtitle{
    font-size: 14px;
    font-weight: 500;
}
@media only screen and (max-width: 600px) {
    .title {
        font-size: 14px;
    }

    .subtitle {
        font-size: 13px;
    }

    .search-img {
        width: 70px;
    }
    .info-subtitle{
        font-size: 13px;
        font-weight: 500;
    }
}

</style>
