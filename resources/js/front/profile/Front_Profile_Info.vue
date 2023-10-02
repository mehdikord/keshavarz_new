<script>
import {mapActions, mapGetters} from "vuex";

export default {
    name: "Front_Profile_Info",
    mounted() {
        this.GetProvinces();
        this.GetProfile();
    },
    data(){
        return {
            user:null,
            edit:{
                name:null,
                national_code:null,
                province_id:null,
                city_id:null,
                bio:null,
            },
            edit_loading:false,
            errors:[],
            EditImageDialog:false,
            EditInfoDialog:false,
            edit_image:null,
            edit_image_loading:false,
            remove_image_loading:false,
            show_warning:false,
            provinces:[],
            provinces_select:[],
            cities_select:[],
        }
    },
    methods:{
        ...mapActions([
            "ProfilesUserMe",
            "ProfileUserUpdateStorage",
            "ProfilesUserUpdateImage",
            "ProfilesUserUpdate",
            "Auth_User_Logout"
        ]),
        GetProfile(){
            this.ProfilesUserMe().then(res => {
                this.user = res.data.result;
                this.edit.name=this.user.name;
                this.edit.national_code=this.user.national_code;
                this.edit.province_id=this.user.province_id;
                this.edit.city_id=this.user.city_id;
                this.edit.bio=this.user.bio;
                if (!this.user.national_code || !this.user.province || !this.user.city){
                    this.show_warning=true;
                }
            }).catch(error => {
                return this.NotifyServerError();
            })

        },
        UpdateImage(){
            if (!this.edit_image){
                return this.NotifyError('فایل تصویر را انتخاب کنید')
            }
            this.edit_image_loading=true;
            this.ProfilesUserUpdateImage(this.edit_image).then(res => {
                this.user.profile = res.data.result;
                this.ProfileUserUpdateStorage();
                this.edit_image=null;
                this.EditImageDialog=false;
                this.edit_image_loading=false;
                return this.NotifySuccess("تصویر پروفایل باموفقیت ویرایش شد");
            }).catch(error => {
                this.edit_image_loading=false;
                if (error.response.status === 422) {
                    this.errors = error.response.data
                }else {
                    return this.NotifyServerError();
                }
            })


        },
        UpdateInfo(){
            this.edit_loading=true;
            this.edit.national_code = this.$filters.persianDigitsToEnglish(this.edit.national_code)
            this.ProfilesUserUpdate(this.edit).then(res => {
                this.user = res.data.result;
                this.ProfileUserUpdateStorage();
                this.EditInfoDialog=false;
                this.edit_loading=false;
                return this.NotifySuccess("اطلاعات حساب کاربری باموفقیت ویرایش شد");
            }).catch(error => {
                this.edit_loading=false;
                if (error.response.status === 422) {
                    this.errors = error.response.data
                }else {
                    return this.NotifyServerError();
                }
            })

        },
        RemoveImage(){
            this.remove_image_loading=true;
            this.ProfilesUserUpdateImage(null).then(res => {
                this.user.profile = null
                this.ProfileUserUpdateStorage();
                this.EditImageDialog=false;
                this.remove_image_loading=false;
                return this.NotifySuccess("تصویر پروفایل باموفقیت حذف شد");
            }).catch(error => {
                this.remove_image_loading=false;
                if (error.response.status === 422) {
                    this.errors = error.response.data
                }else {
                    return this.NotifyServerError();
                }

            })
        },
        GetProvinces(){
            axios.get('public/provinces').then(res =>{
                this.provinces = res.data.result;
                this.provinces.forEach(province => {
                    this.provinces_select.push({label : province.name , value : province.id})
                })
            })
        },
        Logout(){
            this.$q.dialog({
                title: 'هشدار !',
                message: 'آیا برای خروج از حساب کاربری خود اطمینان دارید ؟',

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
                this.Auth_User_Logout()
                window.open('/','_self')
            }).onCancel(() => {
                // console.log('>>>> Cancel')
            }).onDismiss(() => {
                // console.log('I am triggered on both OK and Cancel')
            })
        },

    },
    computed:{
        ...mapGetters({
            AuthUser : "AuthUserUser"
        }),
        GetCities(){
            if (this.edit.province_id){
                let cities;
                this.provinces.forEach(province =>{
                    if (province.id === this.edit.province_id){
                        cities = province.cities;
                    }
                })
                this.cities_select=[];
                cities.forEach(city => {
                    this.cities_select.push({label : city.name , value : city.id})
                })
            }
        }
    }
}
</script>

<template>
    <div class="row  justify-center">

        <div class="col-xl-8 col-lg-8 col-md-10 col-sm-12 col-xs-12">
            <q-banner v-show="show_warning" dense class="bg-yellow-9 q-mb-sm" rounded >
                <template v-slot:avatar>
                    <q-icon name="fas fa-triangle-exclamation fa-beat" color="black" />
                </template>
                <div class="warning-text">
                    کاربر گرامی اطلاعات حساب کاربری شما کامل نمیباشد ( استان ، شهر ، کد ملی ) توجه داشته باشید برای استفاده کامل از خدمات کشاورز باید ابتدا اطلاعات خود را کامل کنید
                </div>
            </q-banner>
            <q-card>
                <q-card-section class="bg-teal-7">
                    <div class="head-title text-white">اطلاعات حساب کاربری</div>
                </q-card-section>
                <q-card-section>
                    <template v-if="!user">
                        <global_info_loading></global_info_loading>
                    </template>
                    <div v-else class="row">
                        <div class="col-xl-1 col-lg-1 col-md-1">
                            <q-img :src="user.profile ?? '/front/images/user.png'" class="profile-image">
                                <div @click="EditImageDialog=true" class="absolute-bottom-left edit-icon cursor-pointer">
                                    <q-icon color="yellow-9"  name="fas fa-edit"></q-icon>
                                </div>
                            </q-img>

                        </div>
                        <div class="col-xl-11 col-lg-11 col-md-11 q-px-lg">

                            <div class="row q-gutter-x-xl q-gutter-y-lg q-px-md">
                                <div class="col-auto col-md-3 col-sm-12 col-xs-12">
                                    <span class="profile-title text-blue-8">نام کامل : </span>
                                    <span class="profile-text q-ml-xs">{{user.name}}</span>
                                </div>
                                <div class="col-auto col-md-3 col-sm-12 col-xs-12">
                                    <span class="profile-title text-blue-8">شماره موبایل : </span>
                                    <span class="profile-text q-ml-xs">{{user.phone}}</span>
                                </div>
                                <div class="col-auto col-md-3 col-sm-12 col-xs-12">
                                    <span class="profile-title text-blue-8">کد ملی : </span>
                                    <span class="profile-text q-ml-xs">{{user.national_code ?? '---'}}</span>
                                </div>
                                <div class="col-auto col-md-3 col-sm-12 col-xs-12">
                                    <span class="profile-title text-blue-8">استان : </span>
                                    <span class="profile-text q-ml-xs">
                                          <template v-if="user.province">{{user.province.name}}</template>
                                          <template v-else>---</template>
                                      </span>
                                </div>
                                <div class="col-auto col-md-3 col-sm-12 col-xs-12">
                                    <span class="profile-title text-blue-8">شهر : </span>
                                    <span class="profile-text q-ml-xs">
                                          <template v-if="user.city">{{user.city.name}}</template>
                                          <template v-else>---</template>
                                      </span>
                                </div>
                                <div class="col-12">
                                    <span class="profile-title text-blue-8"> بیوگرافی : </span>
                                    <p class="profile-bio text-justify q-mt-xs">
                                        {{user.bio}}
                                    </p>
                                </div>
                                <div class="col-12 col-sm-12 col-xs-12 text-right">
                                    <q-btn @click="EditInfoDialog = true" color="indigo" glossy icon="fas fa-edit q-mr-sm" class="profile-edit-btn q-mb-sm">ویرایش اطلاعات کاربری</q-btn>
                                    <q-btn @click="Logout" color="red" glossy icon="fas fa-times q-mr-sm" class="profile-edit-btn q-ml-sm q-mb-sm">خروج از حساب</q-btn>
                                </div>

                            </div>

                        </div>
                    </div>
                </q-card-section>
            </q-card>
            <q-dialog v-model="EditImageDialog">
                <q-card class="edit-image-card" >
                    <q-card-section class="row items-center q-pb-none">
                        <div class="edit-image-title">
                            ویرایش تصویر پروفایل
                        </div>
                        <q-space />
                        <q-btn icon="fas fa-times" color="red" flat round dense v-close-popup />
                    </q-card-section>
                    <q-card-section class="q-pb-none">
                        <div class="edit-image-desc">
                            <q-icon name="fas fa-info-circle" color="blue"></q-icon>
                            برای ویرایش تصویر پروفایل از فرم زیر فایل جدید را انتخاب کنید و دکمه ویرایش تصویر را کلیک کنید و یا برای حذف تصویر از دکمه حذف تصویر فعلی استفاده کنید.
                        </div>
                    </q-card-section>
                    <q-card-section>
                        <q-file outlined v-model="edit_image" label="انتخاب تصویر جدید" :error="this.MixinValidationCheck(errors,'image')">
                            <template v-slot:prepend>
                                <q-icon name="fas fa-image" />
                            </template>
                            <template v-slot:error>
                                <Error_Validation :errors="this.MixinValidation(errors,'image')"></Error_Validation>
                            </template>
                        </q-file>
                        <div class="edit-btn-box">
                            <q-btn glossy @click="UpdateImage" :loading="edit_image_loading" color="green-7" class="edit-btn" icon="fas fa-edit q-mr-sm">ویرایش تصویر</q-btn>
                            <q-btn glossy @click="RemoveImage" :loading="remove_image_loading" color="red" class="edit-btn q-ml-sm" icon="fas fa-times q-mr-sm" :disable="!user.profile">حذف تصویر</q-btn>
                        </div>
                    </q-card-section>

                </q-card>
            </q-dialog>
            <q-dialog position="top"  v-model="EditInfoDialog" >

                <q-card class="edit-info-card">
                    <q-card-section class="q-pb-sm">
                        <div class="edit-info-title text-deep-orange-9">
                            ویرایش اطلاعات حساب کاربری
                        </div>
                    </q-card-section>
                    <q-card-section>
                        <div class="info-box">
                            <q-input v-model="edit.name" outlined color="green-7" label="نام کامل" :error="this.MixinValidationCheck(errors,'name')">
                                <template v-slot:error>
                                    <Error_Validation :errors="this.MixinValidation(errors,'name')"></Error_Validation>
                                </template>
                            </q-input>
                        </div>
                        <div class="info-box">
                            <q-select
                                outlined
                                v-model="edit.province_id"
                                color="green-7"
                                transition-show="flip-up"
                                transition-hide="flip-down"
                                use-input
                                label="انتخاب استان"
                                :options="provinces_select"
                                emit-value
                                map-options
                                behavior="menu"
                                @change="GetCities"
                                :error="this.MixinValidationCheck(errors,'province_id')"
                            >
                                <template v-slot:error>
                                    <Error_Validation :errors="this.MixinValidation(errors,'province_id')"></Error_Validation>
                                </template>
                            </q-select>
                        </div>
                        <div class="info-box">
                            <q-select
                                outlined
                                v-model="edit.city_id"
                                color="green-7"
                                transition-show="flip-up"
                                transition-hide="flip-down"
                                use-input
                                label="انتخاب شهر"
                                :options="cities_select"
                                emit-value
                                map-options
                                behavior="menu"
                                :error="this.MixinValidationCheck(errors,'city_id')"
                            >
                                <template v-slot:error>
                                    <Error_Validation :errors="this.MixinValidation(errors,'city_id')"></Error_Validation>
                                </template>
                            </q-select>
                        </div>
                        <div class="info-box">
                            <q-input v-model="edit.national_code" outlined color="green-7" label="کد ملی" :error="this.MixinValidationCheck(errors,'national_code')">
                                <template v-slot:error>
                                    <Error_Validation :errors="this.MixinValidation(errors,'national_code')"></Error_Validation>
                                </template>
                            </q-input>
                        </div>
                        <div class="info-box">
                            <q-input hint="توضیحاتی کوتاه درمورد خودتان" type="textarea" v-model="edit.bio" outlined color="green-7" label="بیوگرافی ( اختیاری )">
                            </q-input>
                        </div>
                        <div class="btn-box text-right">
                            <q-btn glossy :loading="edit_loading" @click="UpdateInfo" class="edit-form-btn" color="green-7" icon="fas fa-check q-mr-xs">ویرایش اطلاعات</q-btn>
                            <q-btn glossy v-close-popup color="grey-7" icon="fas fa-times q-mr-xs" class="q-ml-sm edit-form-btn">بستن</q-btn>
                        </div>
                    </q-card-section>

                </q-card>

            </q-dialog>
        </div>

    </div>
</template>

<style scoped>
.warning-text{
    font-size: 13px;
}
.head-title{
    font-size: 18px;
    font-weight: 700;
}
.profile-image{
    width: 90px;
}
.edit-icon{
    padding: 3px 4px;
    border-radius:5px ;
}
.edit-image-title{
    font-size: 16px;
    font-weight: 600;
}
.edit-image-card{
    width: 800px;
}
.edit-btn-box{
    margin-top: 20px;
}
.edit-btn{
    font-size: 12px;
}
.profile-title{
    font-size: 13px;
    font-weight: 450;
}
.profile-text{
    font-size: 14px;
    font-weight: 550;
}
.profile-edit-btn{
    font-size: 13px;
}
.edit-info-title{
    font-size: 16px;
    font-weight: 600;
}
.edit-info-card{
    max-width: 1024px;
    width: 900px;
}
.info-box{
    margin-bottom: 35px;
}
.edit-form-btn{
    font-size: 13px;
}
@media only screen and (max-width: 600px) {

    .warning-text{
        font-size: 12px;
    }
    .head-title{
        font-size: 16px;
        font-weight: 600;
        text-align: center;
    }
    .profile-image{
        width: 90px;
        margin-bottom: 25px;
    }
    .edit-icon{
        padding: 3px 4px;
        border-radius:5px ;
    }
    .edit-image-title{
        font-size: 14px;
        font-weight: 500;
    }
    .edit-image-card{
        width: 100%!important;
    }
    .edit-btn-box{
        margin-top: 10px;
    }
    .edit-btn{
        font-size: 12px;
    }
    .profile-title{
        font-size: 13px;
        font-weight: 450;
    }
    .profile-text{
        font-size: 14px;
        font-weight: 550;
    }
    .profile-edit-btn{
        font-size: 12px;
    }
    .edit-info-title{
        font-size: 14px;
        font-weight: 600;
    }
    .edit-info-card{

    }
    .info-box{
        margin-bottom: 6px;
    }
    .edit-form-btn{
        font-size: 13px;
    }



}


</style>
