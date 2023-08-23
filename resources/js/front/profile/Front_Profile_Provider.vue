<script>
import NeshanMap from "@neshan-maps-platform/vue3-openlayers";
import {mapActions} from "vuex";

export default {
    name: "Front_Profile_Provider",
    components: {
        NeshanMap,
    },
    mounted() {
        this.GetProfile();

    },
    data(){
        return{
            user:null,
            range:20,
            location:[],
            show_map:false,
        }
    },
    methods:{
        ...mapActions([
            "ProfilesUserMe",
        ]),
        Map_Marker(e){
            if (e.coords){
                console.log(e.coords)
                this.location.push(e.coords[1]);
                this.location.push(e.coords[0]);
            }
        },
        GetProfile(){
            this.ProfilesUserMe().then(res => {
                this.user = res.data.result;
                this.range= this.user.search_range
            }).catch(error => {
                return this.NotifyServerError();
            })

        },
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
                    <global_info_loading class="q-mt-xl" v-if="!user"></global_info_loading>
                    <template v-else>

                        <q-card>
                            <q-card-section class="info-title bg-teal-7 text-white">
                                اطلاعات مربوط به موقعیت جغرافیایی و محدوده فعالیت
                            </q-card-section>
                            <q-card-section>
                                <div class="info-subtitle text-green-8">
                                    محدوده فعالیت ( کیلومتر ) : <span class="range text-blue-8">{{range}}</span>
                                </div>
                                <div class="info-subtitle-small q-mt-xs q-mb-mb text-grey-7">
                                    محدوده ای است که اگر کشاورزی در این محدوده ( درفاصله کمتر از 40 کیلیومتری شما) درخواست خدمات کند ، سیستم کشاورز شما را به عنوان ارائه دهنده خدمات انتخاب خواهد کرد
                                </div>
                                <div class="q-mt-md q-mb-lg">
                                    <q-slider
                                        v-model="range"
                                        :min="10"
                                        :max="100"
                                        :step="1"
                                        track-size="6px"
                                        label
                                        :label-value="range + ' کیلومتر '"
                                        label-always
                                        switch-label-side
                                        color="blue-8"
                                    />
                                </div>
                                <q-separator class="q-mt-xl"/>

                                <div class="location-box">
                                    <div class="info-subtitle text-green-8">
                                        موقعیت جغرافیایی : <span class="q-ml-sm">
                                        <span class="text-blue-8" v-if="user.search_location">
                                            انتخاب شده
                                        </span>
                                        <span v-else class="text-red">
                                            انتخاب نشده
                                        </span>
                                    </span>
                                    </div>
                                    <div class="info-subtitle-small q-mt-xs q-mb-mb text-grey-7">
                                        موقعیت جغرافیایی شما که محدوده فعالیت تعیین شما توسط شما از آن نقطعه محاسبه میشود
                                    </div>
                                    <div class="text-center q-mt-lg">
                                        <q-btn @click="show_map=!show_map" color="deep-purple-10" class="open-map-btn">باز کردن نقشه</q-btn>
                                    </div>
                                    <div v-show="location.length" class="q-mt-md text-green-8 text-center location-select">
                                        <q-icon name="fas fa-check"/>
                                        <span class="q-ml-sm">مختصات انتخاب شده است</span>
                                    </div>
                                    <div class="q-mt-md q-mb-md">

                                        <div v-if="show_map" class="map">
                                            <NeshanMap
                                                mapKey="web.eaf4d6d0f42a400bb9583fbd8496947f"
                                                :center="{ latitude: 35.70222201840939, longitude: 51.35178336960962 }"
                                                :zoom="10"
                                                hide-layers
                                                :hide-search-container="true"
                                                @on-click="Map_Marker"

                                            />
                                        </div>
                                    </div>
                                </div>
                                <q-separator class="q-mt-lg"/>
                                <div class="q-mt-lg q-mb-lg text-center">
                                    <q-btn color="green-8" class="location-btn-save" glossy icon="fas fa-floppy-disk q-mr-sm">بروز رسانی اطلاعات  </q-btn>
                                </div>
                            </q-card-section>
                        </q-card>

                    </template>

                </template>
            </div>
        </div>
    </div>
</template>

<style scoped>
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
.info-title{
    font-size: 15px;
    font-weight: 500;
}
.info-subtitle{
    font-size: 14px;
    font-weight: 500;
}
.info-subtitle-small{
    font-size: 12px;
    font-weight: 500;
}
.range{
    font-size: 17px;
    font-weight: 700;
}
.location-box{
    margin-top: 15px;
}
.open-map-btn{
    width: 50%;
    font-size: 13px;
}
.map{
    width: 100%;
    height: 400px;
}
.location-select{
    font-size: 14px;
    font-weight: 550;
}
.location-btn-save{
    font-size: 15px;
}
@media only screen and (max-width: 600px) {

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
    .info-title{
        font-size: 14px;
        font-weight: 450;
        text-align: center;
    }
    .info-subtitle{
        font-size: 13px;
        font-weight: 500;
    }
    .info-subtitle-small{
        font-size: 11px;
        font-weight: 500;
    }
    .location-select{
        font-size: 13px;
        font-weight: 550;
    }
    .open-map-btn{
        width: 50%;
        font-size: 12px;
    }
    .map{
        width: 100%;
        height: 300px;
    }
    .location-btn-save{
        font-size: 13px;
    }
}
</style>
