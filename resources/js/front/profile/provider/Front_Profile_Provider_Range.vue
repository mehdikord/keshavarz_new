<script>
// import NeshanMap from "@neshan-maps-platform/vue3-openlayers";
import {mapActions} from "vuex";
import Front_Global_Map from "../../globals/Front_Global_Map.vue";

export default {
    name: "Front_Profile_Provider_Range",
    components:{
        'global_map' : Front_Global_Map,
    },
    mounted() {
        if (this.AuthUserCheck()){
            this.GetProfile();
        }
    },
    data(){
        return {
            user:null,
            errors:[],
            range:20,
            location:[],
            location_loading:false,
            show_map:false,
            marker:[54.42974568989692,36.83880762411505],
        }
    },
    methods:{
        ...mapActions([
            "ProfilesUserMe",
            "ProfilesUserRangeUpdate",
        ]),

        Map_Marker(e){
            if (e.coords){
                this.location=[];
                this.location.push(e.coords[1]);
                this.location.push(e.coords[0]);
            }
        },
        GetProfile(){
            this.ProfilesUserMe().then(res => {
                this.user = res.data.result;
                this.range= this.user.search_range
                // if (this.user.search_location){
                //     this.marker= JSON.parse( this.user.search_location)
                // }
            }).catch(error => {
                return this.NotifyServerError();
            })

        },
        UpdateRange(){
            if (!this.location.length){
                return this.NotifyError("موقعیت جغرافیایی را از نقشه انتخاب کنید")
            }
            this.location_loading=true;
            this.ProfilesUserRangeUpdate({range:this.range,location:this.location}).then(res => {
                this.location=[];
                this.GetProfile();
                this.location_loading=false;
                return this.NotifySuccess("تنظیمات موقعیت و محدوده فعالیت باموفقیت بروزرسانی شد")
            }).catch(error=>{
                this.location_loading=false;
                return this.NotifyServerError();
            })

        },


    }
}
</script>

<template>

    <div class="row justify-center">
        <div class="col-lg-9 col-sm-12 col-xs-12">
            <div>
                <q-img class="search-img" src="/front/images/map.png"></q-img>
                <strong class="text-green-7 title q-ml-sm">
                    موقعیت مکانی و محدوده فعالیت
                </strong>
                <p class="text-justify q-mt-sm subtitle text-grey-8">
                    محدوده ای است که اگر کشاورزی در این محدوده ( درفاصله کمتر از 40 کیلیومتری شما) درخواست خدمات کند ، سیستم کشاورز شما را به عنوان ارائه دهنده خدمات انتخاب خواهد کرد
                </p>
            </div>
            <div class="text-right">
                <q-btn :to="{name : 'profile_provider'}" color="red" size="sm" class="font-12" icon-right="fas fa-arrow-left q-ml-xs" glossy >بازگشت</q-btn>
            </div>
            <q-separator class="q-mt-sm q-mb-md" color="grey-2"/>

            <global_info_loading class="q-mt-xl" v-if="!user"></global_info_loading>

            <template v-else>
                <q-card>
                    <q-card-section>
                        <div class="info-subtitle text-red">
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
                    </q-card-section>
                </q-card>
                <q-card class="q-mt-sm">
                    <q-card-section>
                        <div class="location-box">
                            <div class="info-subtitle text-red">
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
                            <div class="q-mt-md q-mb-md">
                                <global_map @UpdateLocation="(e) => {this.location = e}"  :marker="marker" />
                            </div>
                        </div>
                        <q-separator class="q-mt-lg"/>
                        <div class="q-mt-lg q-mb-lg text-center">
                            <q-btn  @click="UpdateRange" :loading="location_loading" color="green-8" class="location-btn-save" glossy icon="fas fa-floppy-disk q-mr-sm">بروز رسانی اطلاعات  </q-btn>
                        </div>
                    </q-card-section>
                </q-card>
            </template>

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
    font-size: 15px;
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
    font-size: 14px;
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
        font-size: 14px;
    }
    .map{
        width: 100%;
        height: 300px;
    }
    .location-btn-save{
        font-size: 12px;
    }

}

</style>
