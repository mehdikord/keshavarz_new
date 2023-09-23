<script>
import NeshanMap from "@neshan-maps-platform/vue3-openlayers";
import {mapActions} from "vuex";

export default {
    name: "Front_Profile_Provider",
    components: {
        NeshanMap,
    },
    mounted() {
        if (this.AuthUserCheck()){
            this.GetProfile();
            this.GetUserImplement();
            this.GetUserGallery();
            this.GetUserDays();
        }


    },
    data(){
        return{
            user:null,
            user_implements:[],
            user_gallery:[],
            user_implement_loading:false,
            user_gallery_loading:false,
            user_days_loading:true,
            user_days_add_loading:false,
            gallery_add:null,
            errors:[],
            range:20,
            location:[],
            location_loading:false,
            implement_loading:false,
            gallery_loading:false,
            show_map:false,
            forms_loading:false,
            AddImplementDialog:false,
            AddGalleryDialog:false,
            EditImplementDialog:[],
            category_id: null,
            implement_id: null,
            loading_select_category:false,
            loading_select_implements:false,
            categories :[],
            implements :[],
            implement:null,
            implement_price:'',
            price:null,
            forms:{},
            days:[],
            date:[],

        }
    },
    methods:{
        ...mapActions([
            "ProfilesUserMe",
            "ProfilesUserRangeUpdate",
            "ImplementsCategoriesSelectIndex",
            "ImplementsSelectIndex",
            "ImplementsShow",
            "ProfilesUserImplementStore",
            "ProfilesUserImplement",
            "ProfilesUserImplementDelete",
            "ProfilesUserImplementUpdate",
            "ProfilesUserGallery",
            "ProfilesUserGalleryStore",
            "ProfilesUserGalleryDelete",
            "ProfilesUserDays",
            "ProfilesUserDaysStore",
            "ProfilesUserDaysDelete"
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
                if (this.user.search_location){
                    this.location= this.user.search_location
                }
            }).catch(error => {
                return this.NotifyServerError();
            })

        },
        GetUserImplement(){
            this.user_implement_loading=true;
            this.ProfilesUserImplement().then(res => {
                this.user_implements = res.data.result;
                this.user_implement_loading=false;
            }).catch(error => {
                this.user_implement_loading=false;
                return this.NotifyServerError();
            })

        },
        GetUserGallery(){
            this.user_gallery_loading=true;
            this.ProfilesUserGallery().then(res => {
                this.user_gallery = res.data.result;
                this.user_gallery_loading=false;
            }).catch(error =>{
                this.user_gallery_loading=false;
                this.NotifyServerError();
            })
        },
        UpdateRange(){
            if (!this.location.length){
                return this.NotifyError("موقعیت جغرافیایی را از نقشه انتخاب کنید")
            }
            this.location_loading=true;
            this.ProfilesUserRangeUpdate({range:this.range,location:this.location}).then(res => {
                this.user.search_location = res.data.result.search_location;
                this.user.search_range = res.data.result.search_range;
                this.location_loading=false;
                return this.NotifySuccess("تنظیمات موقعیت و محدوده فعالیت باموفقیت بروزرسانی شد")
            }).catch(error=>{
                this.location_loading=false;
                return this.NotifyServerError();
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
        AddImplement(){
            this.implement_loading=true;
            let items = {
                implement_id : this.implement_id,
                price :this.$filters.persianDigitsToEnglish(this.price),
                forms : this.forms
            }
            this.ProfilesUserImplementStore(items).then(res => {
                this.GetUserImplement();
                this.implement_loading=false;
                this.AddImplementDialog=false;
                this.NotifySuccess("خدمت جدید با موفقیت به لیست خدمات شما اضافه شد")
            }).catch(error => {
                this.implement_loading=false;
                if (error.response.status === 409) {
                    this.NotifyError(error.response.data.error);
                }else if (error.response.status === 422) {
                    this.NotifyError("اطلاعات وارد شده ناقص است")
                }else {
                    return this.NotifyServerError();
                }

            })
        },
        AddGallery(){
            if (!this.gallery_add){
                return this.NotifyError('تصویر را انتخاب کنید')
            }
            this.gallery_loading=true;
           let item ={image:this.gallery_add}
            this.ProfilesUserGalleryStore(item).then(res => {
                this.user_gallery.push(res.data.result);
                this.gallery_loading=false;
                this.AddGalleryDialog=false;
                this.NotifySuccess("تصویر جدید باموفقیت به گالری شما اضافه شد")
            }).catch(error => {
                this.gallery_loading=false;
                if (error.response.status === 409) {
                    this.NotifyError(error.response.data.error);
                }else if (error.response.status === 422) {
                    this.NotifyError("اطلاعات وارد شده ناقص است")
                }else {
                    return this.NotifyServerError();
                }

            })
        },
        RemoveImplement(item){
            this.$q.dialog({
                title: 'هشدار !',
                message: 'آیا مطمئن هستید آیتم مورد نظر از لیست خدمات شما حذف شود ؟',

                ok: {
                    glossy: true,
                    color:'positive',
                },
                cancel: {
                    glossy: true,
                    color: 'red'
                },
                persistent: true
            }).onOk(() => {
                this.ProfilesUserImplementDelete(item).then(res => {
                    this.GetUserImplement();
                    return this.NotifyDelete();
                }).catch(error => {
                    return  this.NotifyServerError();
                })

            }).onCancel(() => {
                // console.log('>>>> Cancel')
            }).onDismiss(() => {
                // console.log('I am triggered on both OK and Cancel')
            })
        },
        RemoveGallery(item){
            this.$q.dialog({
                title: 'هشدار !',
                message: 'آیا مطمئن هستید آیتم مورد نظر از گالری شما حذف شود ؟',

                ok: {
                    glossy: true,
                    color:'positive',
                },
                cancel: {
                    glossy: true,
                    color: 'red'
                },
                persistent: true
            }).onOk(() => {
                this.ProfilesUserGalleryDelete(item).then(res => {
                    this.GetUserGallery();
                    return this.NotifyDelete();
                }).catch(error => {
                    return  this.NotifyServerError();
                })

            }).onCancel(() => {
                // console.log('>>>> Cancel')
            }).onDismiss(() => {
                // console.log('I am triggered on both OK and Cancel')
            })
        },
        UpdateImplement(implement){
            if (!implement.price){
                return this.NotifyError("مبلغ مورد نظر را وارد کنید !");
            }
            this.implement_loading=true;
            this.ProfilesUserImplementUpdate(implement).then(res => {
                this.implement_loading=false;
                this.GetUserImplement();
                this.EditImplementDialog[implement.id]=false;
                return this.NotifyUpdate();
            }).catch(error => {
                this.implement_loading=false;
                return this.NotifyServerError()
            })

        },
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
    computed :{
        Get_Implement(){
            if (this.implement_id){
                this.forms_loading=true;
                this.ImplementsShow(this.implement_id).then(res => {
                    this.implement = res.data.result;
                    if (this.implement.price_type){
                        this.implement_price = this.implement.price_type;
                        if (this.implement.forms.length){
                            this.implement.forms.forEach(form => {
                                this.forms[form.form_id]={id:form.form_id,data : ''};
                            })
                        }
                    }
                    this.forms_loading=false;
                }).catch(error => {
                    this.forms_loading=false;
                    return this.NotifyServerError()
                })

            }
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
                                    <q-btn  @click="UpdateRange" :loading="location_loading" color="green-8" class="location-btn-save" glossy icon="fas fa-floppy-disk q-mr-sm">بروز رسانی اطلاعات  </q-btn>
                                </div>
                            </q-card-section>
                        </q-card>

                        <q-card class="q-mt-lg">
                            <q-card-section class="info-title bg-orange-10 text-white">
                                اطلاعات مربوط به ادوات قابل ارائه
                            </q-card-section>
                            <q-card-section>
                                <div class="info-subtitle text-green-8">
                                     خدمات قابل ارائه توسط شما :
                                </div>
                                <div class="info-subtitle-small q-mt-xs q-mb-mb text-grey-7">
                                    لیست خدماتی که توسط شما با مبلغ تعیین شده قابل ارائه است . توجه داشته باشید مبلغ های تعیین شده کمتر نسبت به دیگر ارائه دهندگان خدمات شانش بیشتری برای انتخاب شدن دارند
                                </div>
                                <div class="q-mt-lg q-mb-md text-center">
                                    <q-btn @click="AddImplementDialog=true" class="add-implement-btn" glossy color="teal-7" icon="fas fa-plus q-mr-sm">
                                        افزودن خدمت جدید
                                    </q-btn>
                                    <q-dialog position="top"  v-model="AddImplementDialog" >

                                        <q-card class="add-implement-card">
                                            <q-card-section class="bg-orange-10 text-white">
                                                <div class="add-implement-title">
                                                   افزودن خدمت قابل ارائه جدید
                                                </div>
                                            </q-card-section>
                                            <q-card-section>
                                                <div class="form-box">
                                                    <q-select
                                                        outlined
                                                        color="green-7"
                                                        transition-show="flip-up"
                                                        transition-hide="flip-down"
                                                        v-model="category_id"
                                                        use-input
                                                        label="انتخاب دسته بندی ادوات"
                                                        :options="categories"
                                                        emit-value
                                                        map-options
                                                        @filter="Filter_Select_Category"
                                                        :loading="loading_select_category"
                                                        behavior="menu"
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
                                                        use-input
                                                        label="انتخاب ادوات"
                                                        :options="implements"
                                                        emit-value
                                                        map-options
                                                        @filter="Filter_Select_Implement"
                                                        :loading="loading_select_implements"
                                                        behavior="menu"
                                                        @change="Get_Implement"
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
                                                    <q-input
                                                        :label="'قیمت خدمت قابل ارائه - '+ implement_price +' (تومان) '"
                                                        outlined
                                                        v-model="price"
                                                        color="green-7"
                                                    >
                                                    </q-input>
                                                </div>
                                                <span class="forms-title text-indigo q-mb-sm">افزودن اطلاعات اختیاری : </span>
                                                <div class="q-mt-sm">
                                                    <global_info_loading v-if="forms_loading"></global_info_loading>
                                                    <template v-else>
                                                        <template v-if=" implement && implement.forms.length">
                                                            <div v-for="form in implement.forms" class="form-box">
                                                                    <q-input
                                                                    :label="form.form.name"
                                                                    outlined
                                                                    v-model="forms[form.form_id].data"
                                                                    color="green-7"
                                                                >
                                                                </q-input>
                                                            </div>
                                                        </template>
                                                    </template>
                                                </div>
                                                <div class="q-mt-lg q-mb-sm text-right">
                                                    <q-btn @click="AddImplement" :loading="implement_loading" color="green-7" glossy>ثبت اطلاعات و افزودن</q-btn>
                                                </div>

                                            </q-card-section>

                                        </q-card>

                                    </q-dialog>
                                </div>
                                <q-separator/>
                                <div class="q-mt-md q-mb-lg">
                                    <span class="text-red implement-info">
                                        <q-icon name="fas fa-info-circle"></q-icon>
                                        برای مشاهده ، ویرایش یا حذف هر خدمت روی آن کلیک کنید
                                    </span>

                                    <global_info_loading v-if="user_implement_loading"></global_info_loading>
                                    <div v-else class="row q-mt-md justify-center" >
                                        <div v-if="!user_implements.length" class="col-lg-7 col-md-8 col-sm-12 col-xs-12 text-center">
                                            <span class="q-mt-md text-grey-7 ">
                                                شما هنوز هیچ خدماتی برای خود انتخاب نکرده اید
                                            </span>
                                        </div>
                                        <div v-else v-for="implement in user_implements" class="col-xl-4 col-lg-4 col-sm-12 col-xs-12">
                                            <div class="extra-padding">
                                                <q-expansion-item
                                                    class="shadow-6 overflow-hidden"
                                                    style="border-radius: 20px"
                                                    header-class="bg-teal-9 text-white"
                                                    expand-icon-class="text-white"
                                                >
                                                    <template v-slot:header>
                                                        <div  class="pro-box">
                                                            <span class="pro-title">{{implement.implement.name}} :</span>
                                                            <span class="pro-price">
                                                                <span class="text-yellow-8">{{this.$filters.numbers(implement.price)}}</span>
                                                                <span class="pro-currency q-ml-sm">تومان</span>
                                                                /
                                                                <span class="pro-price-type">
                                                                    {{implement.implement.price_type}}
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </template>
                                                    <q-card>
                                                        <q-card-section>
                                                            <div class="q-mb-md text-center">
                                                                <q-btn @click="EditImplementDialog[implement.id]=true" icon="fas fa-edit q-mr-sm" dense glossy class="imp-edit-btn"  color="primary">ویرایش</q-btn>
                                                                <q-btn @click="RemoveImplement(implement.id)" icon="fas fa-trash q-mr-sm" dense glossy class="imp-edit-btn q-ml-sm"  color="red">حذف</q-btn>

                                                                <q-dialog position="top"  v-model="EditImplementDialog[implement.id]">

                                                                    <q-card class="add-implement-card">
                                                                        <q-card-section class="bg-blue-8 text-white">
                                                                            <div class="add-implement-title">
                                                                                ویرایش قیمت : {{implement.implement.name}}
                                                                            </div>
                                                                        </q-card-section>
                                                                        <q-card-section>
                                                                            <div class="form-box">
                                                                                <q-input
                                                                                    :label="'قیمت خدمت قابل ارائه - '+ implement.implement.price_type +' (تومان) '"
                                                                                    outlined
                                                                                    v-model="implement.price"
                                                                                    color="green-7"
                                                                                >
                                                                                </q-input>
                                                                            </div>
                                                                            <div class="q-mt-lg q-mb-sm text-right">
                                                                                <q-btn v-close-popup color="grey-9" class="q-mr-sm" glossy> بستن</q-btn>

                                                                                <q-btn @click="UpdateImplement(implement)" :loading="implement_loading" color="green-7" glossy> ویرایش قیمت</q-btn>
                                                                            </div>
                                                                        </q-card-section>

                                                                    </q-card>

                                                                </q-dialog>



                                                            </div>
                                                            <div v-if="implement.forms.length" class="form-imp-box" v-for="form in implement.forms">
                                                                <span class="form-imp-title text-red"> {{form.form.name}} : </span>
                                                                <span class="form-imp-text "> {{form.data}} </span>
                                                                <q-separator class="q-mt-sm"/>
                                                            </div>
                                                        </q-card-section>
                                                    </q-card>
                                                </q-expansion-item>

                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </q-card-section>
                        </q-card>

                        <q-card class="q-mt-lg">
                            <q-card-section class="info-title bg-red-6 text-white">
                                روز های تعطیل
                            </q-card-section>
                            <q-card-section>
                                <p>
                                    تاریخ های انتخابی در این قسمت بیانگر فعالیت نداشتن شما در آن روز است که به جستجو کننده خدمات نشان داده میشود
                                </p>
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

                        <q-card class="q-mt-lg">
                            <q-card-section class="info-title bg-indigo text-white">
                                گالری تصاویر خدمت دهنده
                            </q-card-section>
                            <q-card-section>
                                <div class="info-subtitle text-green-8">
                                     تصاویر ادوات شما :
                                </div>
                                <div class="info-subtitle-small q-mt-xs q-mb-mb text-grey-7">
                                     شما میتوانید تصاویر مربوط به ادوات کشاورزی خود را در این قسمت وارد کنید ، و کشاورز تصاویر گالری و ادوات شما را مشاهده میکند
                                </div>
                                <div class="q-mt-lg q-mb-md text-center">
                                    <q-btn @click="AddGalleryDialog=true" class="add-implement-btn" glossy color="teal-7" icon="fas fa-image q-mr-sm">
                                        افزودن تصویر جدید
                                    </q-btn>
                                    <q-dialog position="top"  v-model="AddGalleryDialog" >

                                        <q-card class="add-implement-card">
                                            <q-card-section class="bg-indigo text-white">
                                                <div class="add-implement-title">
                                                    افزودن تصویر جدید به گالری خود
                                                </div>
                                            </q-card-section>
                                            <q-card-section>

                                                <div class="form-box">
                                                    <q-file class="q-mb-md" color="green-7" outlined bottom-slots v-model="gallery_add" label="انتخاب تصویر" counter>
                                                        <template v-slot:prepend>
                                                            <q-icon name="fas fa-image" @click.stop.prevent />
                                                        </template>
                                                        <template v-slot:append>
                                                            <q-icon name="fas fa-times" @click.stop.prevent="gallery_add = null" class="cursor-pointer" />
                                                        </template>
                                                    </q-file>
                                                </div>
                                                <div class="q-mt-lg q-mb-sm text-right">
                                                    <q-btn @click="AddGallery" :loading="gallery_loading" color="green-7" glossy>ثبت و ارسال تصویر</q-btn>
                                                </div>

                                            </q-card-section>

                                        </q-card>

                                    </q-dialog>
                                </div>
                                <div class="q-mt-lg">
                                    <global_info_loading v-if="user_gallery_loading"></global_info_loading>
                                    <template v-else>
                                        <div v-if="!user_gallery.length" class="text-center">
                                            <span class="q-mt-md text-red-5 ">
                                                شما هنوز هیچ تصویری در گالری خود اضافه نکرده اید
                                            </span>
                                        </div>
                                        <div v-else>
                                            <div class="row">
                                                <div v-for="gallery in user_gallery" class="col-xl-2 col-lg-2 col-md-3 col-sm-6 col-xs-6 q-mt-xs">
                                                    <q-card>
                                                        <q-card-section class="text-center" >
                                                            <q-img class="gallery-image" :src="gallery.file"/>
                                                        </q-card-section>
                                                        <q-card-actions>
                                                            <q-icon @click="RemoveGallery(gallery.id)" name="fas fa-trash" color="red"  class="cursor-pointer"></q-icon>
                                                        </q-card-actions>
                                                    </q-card>
                                                </div>
                                            </div>
                                        </div>
                                    </template>

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
.custom-input{
    display: none;
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
    font-size: 14px;
}
.add-implement-btn{
    font-size: 14px;
}
.add-implement-card{
    max-width: 1024px;
    width: 900px;
}
.add-implement-title{
    font-size: 15px;
    font-weight: 550;
}
.form-box{
    margin-bottom: 25px;
}
.forms-title{
    font-size: 14px;
    font-weight: 500;
}
.extra-padding{
    padding: 8px 10px ;
}
.pro-box{
    width: 100%;
    padding: 6px 0;
}
.pro-price-type{
    font-size: 12px;
}
.pro-title{
    font-size: 14px;
    font-weight: 600;
}
.pro-currency{
    font-size: 12px;
}
.pro-price{
    font-size: 16px;
    font-weight: 600;
    margin-left: 5px;
}
.form-imp-box{
    padding: 10px 0;
}
.form-imp-title{
    font-size: 15px;
    font-weight: 600;
}
.form-imp-text{
    font-size: 15px;
    margin-left: 5px;
}
.imp-edit-btn{
    font-size: 13px;
}
.gallery-image{
    width: 200px;
    height: 200px;
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
        font-size: 12px;
    }
    .add-implement-btn{
        font-size: 12px;
    }
    .add-implement-title{
        font-size: 13px;
        font-weight: 550;
    }
    .form-box{
        margin-bottom: 15px;
    }
    .forms-title{
        font-size: 13px;
        font-weight: 500;
    }
    .extra-padding{
        padding: 5px 0 ;
    }
    .pro-box{
        width: 100%;
        padding: 6px 0;
    }
    .pro-price-type{
        font-size: 12px;
    }
    .pro-title{
        font-size: 13px;
        font-weight: 600;
    }
    .pro-currency{
        font-size: 11px;
    }
    .pro-price{
        font-size: 14px;
        font-weight: 600;
        margin-left: 2px;
    }
    .implement-info{
        font-size: 12px;
    }

    .form-imp-box{
        padding: 6px 0;
    }
    .form-imp-title{
        font-size: 14px;
        font-weight: 600;
    }
    .form-imp-text{
        font-size: 13px;
        margin-left: 5px;
    }
    .imp-edit-btn{
        font-size: 12px;
    }
    .gallery-image{
        width: 120px;
        height: 120px;

    }


}
</style>
