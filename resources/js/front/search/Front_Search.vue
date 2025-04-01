<script>
import {mapActions} from "vuex";
import Front_Search_Profile from "@/front/search/Front_Search_Profile.vue";
import Front_Skeleton_Provider from "../skeleton/Front_Skeleton_Provider.vue";
import Front_Search_Requests_Waiting from "./requests/Front_Search_Requests_Waiting.vue";
import Front_Search_Requests_Working from "./requests/Front_Search_Requests_Working.vue";
import moment from "moment-jalaali";
import Front_Global_Map from "../globals/Front_Global_Map.vue";
export default {
    name: "Front_Search",
    mounted() {
      this.Get_Categories();
      this.Get_Implements();
      if (this.AuthUserCheck()){
          this.Check_Customer();
          this.GetCustomerRequests();
          this.GetCustomerWorkingRequests();
          this.Get_Lands();
      }

    },
    components: {
        'search_profile' : Front_Search_Profile,
        'skeleton_provider' : Front_Skeleton_Provider,
        'search_request_waiting' : Front_Search_Requests_Waiting,
        'search_request_working' : Front_Search_Requests_Working,
        'global_map' : Front_Global_Map,


    },
    data(){
        return{
            show_form:true,
            authDialog:false,
            show_map:false,
            category_id: null,
            implement_id: null,
            user_land_id: null,
            area: null,
            location: [],
            category_name: null,
            implement_name: null,
            search_loading:false,
            loading_select_category:false,
            loading_select_implements:false,
            loading_select_lands:false,
            categories :[],
            implements :[],
            lands :[],
            search_result:[],
            request_users:[],
            search_request:null,
            map_zoom:{ latitude: 36.83951508755615, longitude: 54.43313598632812 },
            date:[],
            now_time:moment().format('jYYYY/jM/jD'),

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
            search_expansion:true,
            check_customer : 0,
            customer_requests_loading:true,
            customer_requests:[],
            customer_working_requests_loading:true,
            customer_working_requests:[],
            errors:[],
            AddDialog:false,
            add_loading:false,
            cancel_loading:false,
            add:{
                title:null,
                description:null,
                area:null,
                image:null,
                location:[],

            },
        }
    },

    methods:{
        ...mapActions([
            "ImplementsCategoriesSelectIndex",
            "ImplementsSelectIndex",
            "LandsUserSelectIndex",
            "LandsUserStore",
            "SearchStart",
            "ProfilesUserCheckCustomer",
            "SearchProviderRequestUsers",
            "UserCustomerPending",
            "UserCustomerWorking",

        ]),
        AddItem(){
            if (!this.add.location.length){
                return this.NotifyError("موقعیت جغرافیایی انتخاب نشده است")
            }
            this.add.area = this.$filters.persianDigitsToEnglish(this.add.area)
            this.add_loading=true;
            this.LandsUserStore(this.add).then(res => {
                this.add_loading=false;
                this.add=[];
                this.AddDialog=false;
                this.Get_Lands();
                return this.NotifySuccess(res.data.message);
            }).catch(error => {
                this.add_loading=false;
                if (error.response.status === 409) {
                    this.NotifyError(error.response.data.error);
                }else if (error.response.status === 422) {
                    this.NotifyError("اطلاعات وارد شده ناقص است")
                    return this.errors = error.response.data
                }else {
                    return this.NotifyServerError();
                }

            })

        },
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
        Get_Lands(){
            this.loading_select_lands=true;
            this.LandsUserSelectIndex().then(res => {
                this.lands = res
                this.loading_select_lands=false;
            }).catch(error => {
                this.loading_select_lands=false;
                return  this.NotifyServerError();
            })
        },
        Do_Search(){
            if (!this.AuthUserCheck()){
               return this.authDialog=true;
            }
            if (!this.user_land_id){
                return this.NotifyError("زمین انتخاب نشده")
            }
            if (!this.implement_id){
                return this.NotifyError("ادوات برای جستجو انتخاب نشده")
            }
            if (!this.date.length){
                return this.NotifyError("حداقل یک تاریخ برای انجام کار انتخاب کنید")
            }
            this.search_loading=true;
            this.SearchStart({implement_id : this.implement_id,user_land_id:this.user_land_id,dates:this.date,area:this.area}).then(res => {
                this.search_result=res.data.result.result;
                this.search_request=res.data.result.request;
                this.search_expansion=false;
                // localStorage.setItem('keshavarz_search_result',JSON.stringify(res.data.result));
                this.search_loading=false;
                this.NotifySuccess("جستجو خدمات باموفقیت انجام شد")
                this.GetCustomerRequests()
            }).catch(error=>{
                this.search_loading=false;
                if (error.response.status === 409) {
                    return this.NotifyError(error.response.data.error);
                }


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
        Filter_Select_Lands (val, update, abort) {
            update(() => {
                if (val){
                    this.lands =  this.lands.filter(item => {
                        return item.label !== null && item.label.match(val)
                    })
                }else {
                    this.Get_Lands();
                }
            })
        },
        Map_Marker(e){
            if (e.coords){
                this.add.location = [];
                this.add.location.push(e.coords[1]);
                this.add.location.push(e.coords[0]);
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

        },

        GetCustomerRequests(){

            this.UserCustomerPending().then(res =>{
                this.customer_requests=res.data.result;
                if (this.customer_requests.length){
                    this.GetRequestResult(res.data.result[0]);
                }
                this.customer_requests_loading=false;
            }).catch(error => {

            })

        },

        CancelRequestUsers(item){
           if (this.search_request.id === item){
               localStorage.removeItem('keshavarz_search_result');
               this.search_result=[];
               this.request_users=[];
               this.show_form=true;
           }
            this.GetCustomerRequests();

            return this.NotifySuccess("درخواست مورد نظر باموفقیت حذف گردید");
        },

        GetRequestResult(request){
            this.search_request = request;
            this.GetRequestUsers();
            this.search_result = request.search_result_decode
            this.show_form=false;
            this.ScrollToResult();
        },


        GetRequestUsers(){
            if (this.search_request){
                this.SearchProviderRequestUsers(this.search_request.id).then(res => {
                    this.request_users = res.data.result;
                }).catch(error => {
                    return this.NotifyServerError();
                })
            }
        },

        // Working Request
        GetCustomerWorkingRequests(){
            this.UserCustomerWorking().then(res =>{
                this.customer_working_requests=res.data.result;
                console.log(this.customer_working_requests)
                this.customer_working_requests_loading=false;
            }).catch(error => {

            })
        },

        ScrollToResult(){
            const elementToScrollTo = this.$refs.forscroll;
            elementToScrollTo.scrollIntoView({
                behavior: 'smooth', // Adds smooth scrolling
                block: 'start', // Scrolls to the top of the element
            });
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
                                    dense
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
                                    dense
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
                            <div class="form-box">
                                <q-btn @click="AddDialog = true" class="q-mb-sm font-12" color="indigo" glossy dense icon="fas fa-plus q-mr-xs">افزودن زمین جدید</q-btn>
                                <q-dialog position="top"  v-model="AddDialog" >
                                    <q-card class="add-land-card">
                                        <q-card-section class="bg-teal-8 text-white">
                                            <strong class="add-land-title">
                                                افزودن زمین جدید به لیست
                                            </strong>
                                        </q-card-section>
                                        <q-card-section class="q-mt-sm">
                                            <q-input
                                                label="نام زمین شما"
                                                outlined
                                                v-model="add.title"
                                                color="green-8"
                                                dense
                                                :error="this.MixinValidationCheck(errors,'title')"
                                            >
                                                <template v-slot:error>
                                                    <Error_Validation :errors="this.MixinValidation(errors,'title')"></Error_Validation>
                                                </template>
                                            </q-input>
                                            <q-input
                                                label="مساحت زمین ( به مترمربع )"
                                                outlined
                                                v-model="add.area"
                                                color="green-8"
                                                dense
                                                :error="this.MixinValidationCheck(errors,'area')"

                                            >
                                                <template v-slot:error>
                                                    <Error_Validation :errors="this.MixinValidation(errors,'area')"></Error_Validation>
                                                </template>
                                            </q-input>

                                            <q-file  dense color="green-8" outlined v-model="add.image" label="عکس زمین ( اختیاری )" :error="this.MixinValidationCheck(errors,'image')">
                                                <template v-slot:prepend>
                                                    <q-icon name="fas fa-image" />
                                                </template>
                                                <template v-slot:error>
                                                    <Error_Validation :errors="this.MixinValidation(errors,'image')"></Error_Validation>
                                                </template>

                                            </q-file>
                                            <strong class="text-indigo">انتخاب موقعیت جغرافیایی زمین</strong>
                                            <global_map @UpdateLocation="(e) => {this.add.location = e}"
                                                        :marker="[54.42974568989692,36.83880762411505]"
                                                        class="q-mt-md"></global_map>


                                        </q-card-section>
                                        <div class="text-right q-mb-md q-px-md">
                                            <q-btn v-close-popup glossy color="red-7" class="q-mr-sm add-land-btn" icon-right="fas fa-times q-ml-xs">بستن</q-btn>
                                            <q-btn @click="AddItem" :loading="add_loading" glossy color="green-7" class="add-land-btn" icon-right="fas fa-check q-ml-xs">افزودن زمین</q-btn>
                                        </div>

                                    </q-card>
                                </q-dialog>
                                <q-select
                                    outlined
                                    dense
                                    color="green-7"
                                    transition-show="flip-up"
                                    transition-hide="flip-down"
                                    v-model="user_land_id"
                                    label="انتخاب زمین"
                                    :options="lands"
                                    emit-value
                                    map-options
                                    @filter="Filter_Select_Lands"
                                    :loading="loading_select_lands"
                                    use-input
                                    behavior="dialog"

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
                                                <global_image_lands :image="scope.opt.image"></global_image_lands>
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
                                <q-input
                                    label="متراژ کار"
                                    outlined
                                    type="number"
                                    v-model="area"
                                    color="green-8"
                                    dense
                                    :error="this.MixinValidationCheck(errors,'area')"
                                >
                                    <template v-slot:error>
                                        <Error_Validation :errors="this.MixinValidation(errors,'area')"></Error_Validation>
                                    </template>
                                    <template v-slot:hint>
                                        <p class="text-red font-12">
                                            اگر متراژ کار را وارد نکنید ، کل مساحت زمین برای کار در نظرگرفته میشود
                                        </p>
                                    </template>
                                </q-input>

                            </div>
                            <div class="form-box">

                                <div class="q-mb-sm">
                                    <q-icon name="fas fa-question-circle q-ml-sm font-20" class="text-indigo cursor-pointer float-left">
                                        <q-popup-proxy :offset="[90,10]">
                                            <q-banner class="bg-indigo-6 text-white">
                                                تاریخ های موردنظر خود را برای انجام کار انتخاب کنید تا خدمات دهندگانی که در این زمان قادر به انجام کار هستند جستجو شوند
                                            </q-banner>
                                        </q-popup-proxy>
                                    </q-icon>
                                   <span class="q-ml-sm"> انتخاب تاریخ های انجام کار</span>

                                </div>

                                <PersianDatePicker
                                    multiple
                                    :min="now_time"
                                    inputClass="date-picker"
                                    v-model="date"
                                    placeholder="برای انتخاب تاریخ از تقویم کلیک کنید"
                                />
                            </div>



                            <div class="text-center q-mt-xl">
                                <q-btn @click="Do_Search" glossy rounded color="green"  class="open-map-btn" icon="fas fa-search q-mr-sm"> جستجو خدمات کشاورزی </q-btn>
                            </div>
                        </q-card-section>
                    </q-card>
                </q-expansion-item>

                <template v-if="show_form">
                    <q-card class="q-mt-md rounded-borders">
                        <q-card-section class="mobile-paddoing">
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
                            <global_info_loading v-if="customer_requests_loading"></global_info_loading>
                            <div v-else>
                                <div v-if="customer_requests.length">
                                    <div class="row justify-center">
                                        <div v-for="request in customer_requests" class="col-md-4 col-sm-6 col-xs-12 q-px-sm q-mb-md">
                                            <search_request_waiting :request="request" @CancelRequest="(data) => CancelRequestUsers(data)"></search_request_waiting>
                                        </div>
                                    </div>
                                </div>
                                <div v-else class="text-center q-mt-md">
                                    <q-img src="/front/images/empty.png" class="req-img-empty" />
                                    <div class="q-mt-xs text-grey-7">
                                        درخواست جدیدی وجود ندارد
                                    </div>
                                </div>
                            </div>
                        </q-card-section>
                    </q-card>
                    <q-card class="q-mt-md rounded-borders q-mt-md">
                        <q-card-section class="mobile-padding">
                            <div class="text-center">
                                <strong class="text-grey-9 req-title">درخواست های تایید شده</strong>
                                <q-icon name="fas fa-question-circle q-ml-sm font-20" class="text-indigo cursor-pointer">
                                    <q-popup-proxy :offset="[90,10]">
                                        <q-banner class="bg-indigo-6 text-white">

                                        </q-banner>
                                    </q-popup-proxy>
                                </q-icon>
                            </div>
                            <q-separator class="q-mt-sm" />
                            <global_info_loading v-if="customer_working_requests_loading"></global_info_loading>
                            <div v-else>
                                <div v-if="customer_working_requests.length">
                                    <div class="row justify-center q-mt-md">
                                        <div v-for="request in customer_working_requests" class="col-md-4 col-sm-6 col-xs-12 q-px-sm q-mb-md">
                                            <search_request_working :request="request" @CancelRequest="GetCustomerWorkingRequests"></search_request_working>
                                        </div>
                                    </div>
                                </div>
                                <div v-else class="text-center q-mt-md">
                                    <q-img src="/front/images/empty.png" class="req-img-empty" />
                                    <div class="q-mt-xs text-grey-7">
                                        درخواست جدیدی وجود ندارد
                                    </div>
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
                            <q-card-section class="mobile-padding">
                                <div v-if="customer_requests.length">
                                    <div class="row justify-center">
                                        <div v-for="request in customer_requests" class="col-md-4 col-sm-6 col-xs-12 q-px-sm q-mb-md ">
                                            <search_request_waiting @ChangeSearchData="(data) => GetRequestResult(data)" :request="request" @CancelRequest="(data) => CancelRequestUsers(data)"></search_request_waiting>
                                        </div>
                                    </div>
                                </div>
                                <div v-else class="text-center q-mt-md">
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
                                <strong class="text-teal-7 req-title">درخواست های تایید شده</strong>
                                <q-icon name="fas fa-question-circle q-ml-sm font-20" class="text-indigo cursor-pointer float-left">
                                    <q-popup-proxy :offset="[90,10]">
                                        <q-banner class="bg-indigo-6 text-white">

                                        </q-banner>
                                    </q-popup-proxy>
                                </q-icon>
                            </div>
                        </template>
                        <q-card>
                            <q-card-section class="mobile-padding">
                                <global_info_loading v-if="customer_working_requests_loading"></global_info_loading>
                                <div v-else>
                                    <div v-if="customer_working_requests.length">
                                        <div class="row justify-center q-mt-sm">
                                            <div v-for="request in customer_working_requests" class="col-md-4 col-sm-6 col-xs-12 q-px-sm q-mb-md">
                                                <search_request_working :request="request" @CancelRequest="GetCustomerWorkingRequests"></search_request_working>
                                            </div>
                                        </div>
                                    </div>
                                    <div v-else class="text-center q-mt-md">
                                        <q-img src="/front/images/empty.png" class="req-img-empty" />
                                        <div class="q-mt-xs text-grey-7">
                                            درخواست جدیدی وجود ندارد
                                        </div>
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
                    <template v-if="search_request">
                        <q-separator class="q-mt-md" />
                        <q-banner v-if="check_customer === 0" rounded class="bg-yellow-8">
                            <div class="text-center">
                                <i class="fas fa-triangle-exclamation font-20 q-mr-sm fa-beat text-red-14"></i>
                                <strong>برای ارسال درخواست باید اشتراک فعال خدمات گیرنده داشته باشید</strong>
                            </div>
                        </q-banner>
                        <div  class="q-mt-md">
                            <global_search_loading v-if="search_loading"></global_search_loading>
                            <template v-else>
                                <template v-if="search_result.length">
                                    <div class="q-mb-md search-text text-indigo" ref="forscroll">
                                        <strong>{{ search_result.length }}</strong> کاربر برای ارائه این خدمت یافت شد
                                    </div>
                                    <div class="q-mb-lg" >
                                        <strong>مرتب سازی نتایج بر اساس :</strong>
                                        <div class="q-mt-md" >
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

                                    <search_profile v-for="user in search_result" :user="user" :check_customer="check_customer" :users="request_users" :request_id="search_request.id" @GetReqUsers="GetRequestUsers" class="q-mb-md"></search_profile>

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
                </template>

            </div>

        </div>
    </div>

</template>

<style scoped>
.date-picker{
    padding-top: 20px!important;
    width: 50px!important;
}

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

.search-text{
    font-size: 15px;
    font-weight: 600;
}
.title{
    font-size: 18px;
}
.search-img{
    width: 60px;
}
.form-box{
    margin-bottom: 20px;
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

.location-select{
    font-size: 15px;
    font-weight: 550;
}
.not-found-image{
    width: 150px;
}

.add-land-title{
    font-size: 17px;
}
.add-land-btn{
    font-size: 14px;
}
.add-land-card{
    max-width: 1024px;
    width: 900px;
}
.map{
    width: 100%;
    height: 300px;
}


@media only screen and (max-width: 600px) {
    .mobile-padding{
        padding-left: 1px;
        padding-right: 1px;
    }
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
        margin-bottom: 15px;
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

    .location-select{
        font-size: 14px;
        font-weight: 550;
    }

    .req-title{
        font-size: 13px;
    }
    .add-land-title{
        font-size: 15px;
    }
    .add-land-btn{
        font-size: 14px;
    }
    .map{
        width: 100%;
        height: 250px;
    }

}
</style>
