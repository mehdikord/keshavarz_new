<script>
import {mapActions} from "vuex";
import NeshanMap from "@neshan-maps-platform/vue3-openlayers"
import Front_Search_Profile from "@/front/search/Front_Search_Profile.vue";
import Front_Skeleton_Provider from "../skeleton/Front_Skeleton_Provider.vue";
export default {
    name: "Front_Search",
    mounted() {
      this.Get_Categories();
      this.Get_Implements();
      this.Check_Customer();
      if (localStorage.getItem('keshavarz_search_result')){
          let search_data = JSON.parse(localStorage.getItem('keshavarz_search_result'))
          this.search_result = search_data.result;
          this.search_request = search_data.request;
          this.show_form=false;
      }
    },
    components: {
        NeshanMap,
        'search_profile' : Front_Search_Profile,
        'skeleton_provider' : Front_Skeleton_Provider,

    },
    data(){
        return{
            errors:[],
            show_form:true,
            authDialog:false,
            show_map:false,
            category_id: null,
            implement_id: null,
            location: [],
            category_name: null,
            implement_name: null,
            search_loading:false,
            loading_select_category:false,
            loading_select_implements:false,
            categories :[],
            implements :[],
            search_result:[],
            search_request:null,
            map_zoom:{ latitude: 36.83951508755615, longitude: 54.43313598632812 },
            filter_options : [
                {
                    label: 'تصادفی',
                    value: 'random',
                },
                {
                    label: 'کمترین فاصله',
                    value: 'min_dis',
                },
                {
                    label: 'بیشترین فاصله',
                    value: 'max_dis',
                },
                {
                    label: 'کمترین قیمت',
                    value: 'min_price',
                },
                {
                    label: 'بیشترین قیمت',
                    value: 'max_price',
                }
            ],
            filter_select : 'random',
            search_expansion:false,
            check_customer : 0,


        }
    },

    methods:{
        ...mapActions([
            "ImplementsCategoriesSelectIndex",
            "ImplementsSelectIndex",
            "SearchStart",
            "ProfilesUserCheckCustomer"

        ]),
        Get_Categories(){
                this.loading_select_category=true;
                this.ImplementsCategoriesSelectIndex().then(res => {
                this.categories = res;
                this.loading_select_category=false;
                }).catch(error => {
                    this.loading_select_category=false;
                    return  this.NotifyServerError();
            })
        },
        Get_Implements(){
                this.loading_select_implements=true;
                this.ImplementsSelectIndex(this.category_id).then(res => {
                this.implements = res;
                this.loading_select_implements=false;
                }).catch(error => {
                    this.loading_select_implements=false;
                    return  this.NotifyServerError();
            })
        },
        Do_Search(){
            if (!this.AuthUserCheck()){
               return this.authDialog=true;
            }
            if (!this.location.length){
                return this.NotifyError("مختصات از نقشه انتخاب نشده")
            }
            if (!this.implement_id){
                return this.NotifyError("ادوات برای جستجو انتخاب نشده")
            }
            this.search_loading=true;
            this.SearchStart({implement_id : this.implement_id,location:this.location}).then(res => {
                this.search_result=res.data.result.result;
                this.search_request=res.data.result.request;
                this.search_expansion=false;
                localStorage.setItem('keshavarz_search_result',JSON.stringify(res.data.result));
                this.search_loading=false;
                this.NotifySuccess("جستجو خدمات باموفقیت انجام شد")

            }).catch(error=>{
                return this.NotifyServerError()
            })

            this.show_form=false;
        },
        Filter_Select_Category (val, update, abort) {
            update(() => {
                if (val){
                    this.categories =  this.categories.filter(item => {
                        return item.label !== null && item.label.match(val)
                    })
                }else {
                    this.Get_Categories();
                }
            })
        },
        Filter_Select_Implement (val, update, abort) {
            update(() => {
                if (val){
                    this.implements =  this.implements.filter(item => {
                        return item.label !== null && item.label.match(val)
                    })
                }else {
                    this.Get_Implements();
                }
            })
        },
        Map_Marker(e){
            if (e.coords){
                this.location=[];
                this.location.push(e.coords[1]);
                this.location.push(e.coords[0]);
            }
        },
        getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    this.showPosition,
                    this.showError
                );
            } else {
                alert("مرورگر شما از موقعیت جغرافیایی پشتیبانی نمی‌کند.");
            }
        },
        showPosition(position) {
            this.location = `عرض جغرافیایی: ${position.coords.latitude}, طول جغرافیایی: ${position.coords.longitude}`;
        },
        showError(error) {
            switch (error.code) {
                case error.PERMISSION_DENIED:
                    alert("کاربر اجازه دسترسی به موقعیت جغرافیایی را نداد.");
                    break;
                case error.POSITION_UNAVAILABLE:
                    alert("اطلاعات موقعیت جغرافیایی در دسترس نیست.");
                    break;
                case error.TIMEOUT:
                    alert("زمان درخواست گرفتن موقعیت جغرافیایی پایان یافت.");
                    break;
                case error.UNKNOWN_ERROR:
                    alert("خطای ناشناخته رخ داد.");
                    break;
            }
        },
        markersIconCallback(point) {
            if (point.isReverseMarker) {
                return {
                    src: "https://img.icons8.com/fluency/344/find-clinic.png"
                };
            } else {
                return {
                    src: "https://img.icons8.com/fluency/344/find-clinic.png",
                    iconScale: 0.05
                };
            }
        },
        SearchClear(){
            localStorage.removeItem('keshavarz_search_result')
            this.category_id=null;
            this.implement_id=null;
            this.show_form=true
        },
        SortByKey(array, key, order) {
            return array.sort((a, b) => {
                let comparison = 0;
                if (a[key] > b[key]) {
                    comparison = 1;
                } else if (a[key] < b[key]) {
                    comparison = -1;
                }
                return order === 'desc' ? comparison * -1 : comparison;
            });
        },
        Check_Customer(){
            if (this.AuthUserCheck()){
                this.ProfilesUserCheckCustomer().then(res => {
                    this.check_customer = res.data.result
                }).catch(error => {
                    return this.NotifyServerError();
                })
            }

        }



    },
    computed:{
        Get_Select_Name(){
            if (this.category_id){
                this.categories.forEach(item => {
                    if (item.value === this.category_id){
                    this.category_name = item.label
                    }
                })
            }
            if (this.implements){
                this.implements.forEach(item => {
                    if (item.value === this.implement_id){
                        this.implement_name = item.label
                    }
                })
            }
        },
        Do_Filter(){
            if (this.filter_select === 'min_dis'){
                this.search_result = this.SortByKey(this.search_result,'dis','asc')
            }
            if (this.filter_select === 'max_dis'){
                this.search_result = this.SortByKey(this.search_result,'dis','desc')
            }
            if (this.filter_select === 'min_price'){
                this.search_result = this.SortByKey(this.search_result,'price','asc')
            }
            if (this.filter_select === 'max_price'){
                this.search_result = this.SortByKey(this.search_result,'price','desc')
            }
            if (this.filter_select === 'random'){
                if (localStorage.getItem('keshavarz_search_result')){
                    this.search_result = JSON.parse(localStorage.getItem('keshavarz_search_result')).result;
                }
            }

        }
    },
}
</script>

<template>

    <div class="row justify-center">
        <div class="col-lg-9 col-sm-12 col-xs-12 ">
            <div class="q-mt-md">
                <q-img class="search-img" src="/front/images/search.png"></q-img>
                <strong class="text-green-7 title q-ml-sm">
                    جستجو خدمات کشاورز
                </strong>
                <p class="text-justify q-mt-md">
                    کشاورز عزیز ، شما میتوانید ادوات و خدمات مورد نیاز خود را به سادگی جستجو و دریافت کنید .
                    <br>
                    کافیست اطلاعت مورد نیاز را به دقت وارد کرده و دکمه جستجو را بزنید و در وقت خود صرفه جویی کنید !
                </p>
            </div>
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
            <div v-else class="q-mt-lg">
                <q-expansion-item
                    v-model="search_expansion"
                    class="shadow-4 overflow-hidden"
                    style="border-radius: 5px"
                    header-class="bg-teal-7 text-white"
                    expand-icon-class="text-white"
                >
                    <template v-slot:header>
                        <div class="new-search-header text-center">
                            جستجوی خدمات کشاورزی
                        </div>
                    </template>
                    <q-card>
                        <q-card-section>
                            <div class="form-box">
                                <q-select
                                    outlined
                                    color="green-7"
                                    transition-show="flip-up"
                                    transition-hide="flip-down"
                                    v-model="category_id"
                                    label="انتخاب دسته بندی ادوات"
                                    :options="categories"
                                    emit-value
                                    map-options
                                    @filter="Filter_Select_Category"
                                    :loading="loading_select_category"
                                    use-input
                                    behavior="dialog"
                                    @change="Get_Select_Name"
                                >
                                    <template v-slot:no-option>
                                        <q-item>
                                            <q-item-section class="text-red">
                                                گزینه ای یافت نشد
                                            </q-item-section>
                                        </q-item>
                                    </template>
                                    <template v-slot:option="scope">
                                        <q-item v-bind="scope.itemProps">
                                            <q-item-section avatar>
                                                <global_image_categories :image="scope.opt.image"></global_image_categories>
                                            </q-item-section>
                                            <q-item-section>
                                                <q-item-label>{{ scope.opt.label }}</q-item-label>
                                            </q-item-section>
                                        </q-item>
                                    </template>
                                    <template v-slot:error>
                                    </template>
                                </q-select>
                            </div>
                            <div class="form-box">
                                <q-select
                                    outlined
                                    color="green-7"
                                    transition-show="flip-up"
                                    transition-hide="flip-down"
                                    v-model="implement_id"
                                    label="انتخاب ادوات"
                                    :options="implements"
                                    emit-value
                                    map-options
                                    @filter="Filter_Select_Implement"
                                    :loading="loading_select_implements"
                                    use-input
                                    behavior="dialog"
                                    @change="Get_Select_Name"
                                >
                                    <template v-slot:no-option>
                                        <q-item>
                                            <q-item-section class="text-red">
                                                گزینه ای یافت نشد
                                            </q-item-section>
                                        </q-item>
                                    </template>
                                    <template v-slot:option="scope">
                                        <q-item v-bind="scope.itemProps">
                                            <q-item-section avatar>
                                                <global_image_implements :image="scope.opt.image"></global_image_implements>
                                            </q-item-section>
                                            <q-item-section>
                                                <q-item-label>{{ scope.opt.label }}</q-item-label>
                                            </q-item-section>
                                        </q-item>
                                    </template>
                                    <template v-slot:error>
                                    </template>
                                </q-select>

                            </div>
                            <div class="map-text text-center text-indigo">
                                با استفاده از نقشه زیر ، موقعیت مکانی زمین خود را انتخاب کنید تا ما بتوانیم نزدیک ترین خدمات را برای شما پیدا کنیم
                            </div>
                            <div class="text-center q-mt-lg">
                                <q-btn @click="show_map=!show_map" glossy rounded color="indigo" class="open-map-btn">باز کردن نقشه</q-btn>
                            </div>
                            <div v-show="location.length" class="q-mt-md text-positive text-center location-select">
                                <q-icon name="fas fa-check"/>
                                <span class="q-ml-sm">مختصات انتخاب شده است</span>
                            </div>
                            <div class="q-mt-md q-mb-md">
                                <div v-if="show_map" class="map">
                                    <NeshanMap
                                        mapKey="web.eaf4d6d0f42a400bb9583fbd8496947f"
                                        :center="{ latitude: 36.83951508755615, longitude: 54.43313598632812 }"
                                        :zoom="10"
                                        hide-layers
                                        hide-search-container
                                        @on-click="Map_Marker"
                                    />
                                </div>

                            </div>
                            <div class="q-mt-lg q-mb-lg">
                                <q-separator/>
                            </div>
                            <div class="text-center q-mt-xl">
                                <q-btn @click="Do_Search" glossy rounded color="green"  class="open-map-btn" icon="fas fa-search q-mr-sm"> جستجو خدمات کشاورزی </q-btn>
                            </div>
                        </q-card-section>
                    </q-card>
                </q-expansion-item>

                <template v-if="show_form">
                    <q-card class="q-mt-md rounded-borders">
                        <q-card-section>
                            <div class="text-center">
                                <strong class="text-teal-7 req-title">درخواست های در انتظار تایید</strong>
                                <q-icon name="fas fa-question-circle q-ml-sm font-20" class="text-indigo cursor-pointer">
                                    <q-popup-proxy :offset="[90,10]">
                                        <q-banner class="bg-indigo-6 text-white">

                                        </q-banner>
                                    </q-popup-proxy>
                                </q-icon>
                            </div>
                            <q-separator class="q-mt-sm" />
                            <div class="text-center q-mt-md">
                                <q-img src="/front/images/empty.png" class="req-img-empty" />
                                <div class="q-mt-xs text-grey-7">
                                    درخواست جدیدی وجود ندارد
                                </div>
                            </div>
                        </q-card-section>
                    </q-card>
                    <q-card class="q-mt-md rounded-borders q-mt-md">
                        <q-card-section>
                            <div class="text-center">
                                <strong class="text-grey-9 req-title">درخواست های پایان یافته</strong>
                                <q-icon name="fas fa-question-circle q-ml-sm font-20" class="text-indigo cursor-pointer">
                                    <q-popup-proxy :offset="[90,10]">
                                        <q-banner class="bg-indigo-6 text-white">

                                        </q-banner>
                                    </q-popup-proxy>
                                </q-icon>
                            </div>
                            <q-separator class="q-mt-sm" />
                            <div class="text-center q-mt-md">
                                <q-img src="/front/images/empty.png" class="req-img-empty" />
                                <div class="q-mt-xs text-grey-7">
                                    درخواست جدیدی وجود ندارد
                                </div>
                            </div>
                        </q-card-section>
                    </q-card>

                </template>

                <template v-else>
                    <q-expansion-item
                        class="shadow-4 overflow-hidden q-mt-lg"
                        style="border-radius: 5px"
                        header-class="bg-grey-3"
                    >
                        <template v-slot:header>
                            <div class="req-title text-center" style="width: 100%">
                                <strong class="text-teal-7 req-title">درخواست های در انتظار تایید</strong>
                                <q-icon name="fas fa-question-circle q-ml-sm font-20" class="text-indigo cursor-pointer float-left">
                                    <q-popup-proxy :offset="[90,10]">
                                        <q-banner class="bg-indigo-6 text-white">

                                        </q-banner>
                                    </q-popup-proxy>
                                </q-icon>
                            </div>
                        </template>
                        <q-card>
                            <q-card-section>
                                <div class="text-center q-mt-md">
                                    <q-img src="/front/images/empty.png" class="req-img-empty" />
                                    <div class="q-mt-xs text-grey-7">
                                        درخواست جدیدی وجود ندارد
                                    </div>
                                </div>
                            </q-card-section>
                        </q-card>
                    </q-expansion-item>
                    <q-expansion-item
                        class="shadow-4 overflow-hidden q-mt-md"
                        style="border-radius: 5px"
                        header-class="bg-grey-3"
                    >
                        <template v-slot:header>
                            <div class="req-title text-center" style="width: 100%">
                                <strong class="text-teal-7 req-title">درخواست های پایان یافته</strong>
                                <q-icon name="fas fa-question-circle q-ml-sm font-20" class="text-indigo cursor-pointer float-left">
                                    <q-popup-proxy :offset="[90,10]">
                                        <q-banner class="bg-indigo-6 text-white">

                                        </q-banner>
                                    </q-popup-proxy>
                                </q-icon>
                            </div>
                        </template>
                        <q-card>
                            <q-card-section>
                                <div class="text-center q-mt-md">
                                    <q-img src="/front/images/empty.png" class="req-img-empty" />
                                    <div class="q-mt-xs text-grey-7">
                                        درخواست جدیدی وجود ندارد
                                    </div>
                                </div>
                            </q-card-section>
                        </q-card>
                    </q-expansion-item>
                    <div class="q-mt-lg q-mb-md">
                        <strong class="float-left text-grey-7">
                            نتایج جستجو :
                        </strong>
                        <strong v-if="search_request" class="q-ml-sm text-red">
                            {{search_request.implement.name}}
                        </strong>
                    </div>
                    <q-separator class="q-mt-md" />
                    <q-banner v-if="check_customer === 0" rounded class="bg-yellow-8">
                        <div class="text-center">
                            <i class="fas fa-triangle-exclamation font-20 q-mr-sm fa-beat text-red-14"></i>
                            <strong>برای ارسال درخواست باید اشتراک فعال خدمات گیرنده داشته باشید</strong>
                        </div>
                    </q-banner>
                    <div class="q-mt-md">
                        <global_search_loading v-if="search_loading"></global_search_loading>
                        <template v-else>
                            <template v-if="search_result">
                                <div class="q-mb-md search-text text-indigo">
                                    <strong>{{ search_result.length }}</strong> کاربر برای ارائه این خدمت یافت شد
                                </div>
                                <div class="q-mb-lg">
                                    <strong>مرتب سازی نتایج بر اساس :</strong>
                                    <div class="q-mt-md">
                                        <q-select
                                            filled
                                            rounded
                                            color="indigo"
                                            transition-show="flip-up"
                                            transition-hide="flip-down"
                                            v-model="filter_select"
                                            label="انتخاب ترتیب نمایش"
                                            :options="filter_options"
                                            emit-value
                                            map-options
                                            @change="Do_Filter"
                                            behavior="menu"
                                        >
                                        </q-select>
                                    </div>
                                </div>

                                <search_profile v-for="user in search_result" :user="user" :check_customer="check_customer" :request_id="search_request.id" class="q-mb-md"></search_profile>
                            </template >
                            <template v-else>
                                <div class="text-center ">
                                    <q-img class="not-found-image q-mt-md q-mb-lg" src="/front/images/search-not-found.png"></q-img>
                                    <br>
                                    <strong class="text-indigo">
                                        درحال حاضر هیچ کاربری برای ارائه خدمت مورد نظر شما یافت نشد
                                    </strong>
                                </div>
                            </template>

                        </template>

                    </div>

                </template>

            </div>

        </div>
    </div>

</template>

<style scoped>
.new-search-header{
    font-size: 15px;
    font-weight: 600;
    width: 100%;
    padding-top: 8px;
    padding-bottom: 7px;
}
.req-title{
    font-size: 14px;
}
.req-img-empty{
    width: 60px;
}

.image-dialog{
    width: 860px;
}
.search-text{
    font-size: 15px;
    font-weight: 600;
}
.map{
    width: 100%;
    height: 400px;
}
.title{
    font-size: 18px;
}
.search-img{
    width: 60px;
}
.form-box{
    margin-bottom: 45px;
}
.map-text {
    margin-top: 20px;
    font-size: 16px;
    font-weight: 500;
}

.open-map-btn{
    padding: 10px 40px;
    font-size: 14px;
}
.result-title{
    font-size: 14px;
    font-weight: 500;
}
.result-info{
    font-size: 15px;
    font-weight: 550;
}
.location-select{
    font-size: 15px;
    font-weight: 550;
}
.not-found-image{
    width: 150px;
}

@media only screen and (max-width: 600px) {
    .not-found-image{
        width: 100px;
    }
    .search-text{
        font-size: 14px;
        font-weight: 600;
    }
    .map{
        width: 100%;
        height: 400px;
    }
    .title{
        font-size: 15px;
    }
    .search-img{
        width: 45px;
    }
    .form-box{
        margin-bottom: 30px;
    }
    .map-text {
        margin-top: 20px;
        font-size: 13px;
        font-weight: 500;
    }
    .open-map-btn{
        padding: 10px 40px;
        font-size: 12px;
    }
    .result-title{
        font-size: 14px;
        font-weight: 500;
    }
    .result-info{
        font-size: 13px;
        font-weight: 550;
    }
    .location-select{
        font-size: 14px;
        font-weight: 550;
    }
    .research{
        font-size: 11px;
    }
    .req-title{
        font-size: 13px;
    }

}
</style>
