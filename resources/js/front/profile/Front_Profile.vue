<script>
import Front_Profile_Auth from "./Front_Profile_Auth.vue";
import {mapGetters,mapActions} from "vuex";

export default {
name: "Front_Profile",
    components : {
    'profile_auth' : Front_Profile_Auth,
    },
    mounted() {
    // this.GetProfile();
    },
    data(){
        return {
            user:null,
            EditImageDialog:false,
            edit_image:null,
        }
    },
    methods:{
        ...mapActions([
           "ProfilesUserMe"
        ]),
        GetProfile(){
            this.ProfilesUserMe().then(res => {
                this.user = res.data.result;
                console.log(this.user);
            }).catch(error => {
                return this.NotifyServerError();
            })

        }
    },
   computed:{
       ...mapGetters({
           AuthUser : "AuthUserUser"
       })
   }
}
</script>

<template>
    <profile_auth v-if="!this.AuthUserCheck()"></profile_auth>
    <template  v-else>

        <div class="row  justify-center">
            <div class="col-xl-8 col-lg-8 col-md-10 col-sm-12 col-xs-12">
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
                                <q-img src="/front/images/user.png" class="profile-image">
                                    <div @click="EditImageDialog=true" class="absolute-bottom-left edit-icon cursor-pointer">
                                        <q-icon color="yellow-9"  name="fas fa-edit"></q-icon>
                                    </div>
                                </q-img>
                                <q-dialog v-model="EditImageDialog" >
                                    <q-card class="edit-image-card">
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
                                            <q-file outlined v-model="edit_image" label="انتخاب تصویر جدید">
                                                <template v-slot:prepend>
                                                    <q-icon name="fas fa-image" />
                                                </template>
                                            </q-file>
                                            <div class="edit-btn-box">
                                                <q-btn color="green-7" class="edit-btn" icon="fas fa-edit q-mr-sm">ویرایش تصویر</q-btn>
                                                <q-btn color="red" class="edit-btn q-ml-sm" icon="fas fa-times q-mr-sm">حذف تصویر</q-btn>
                                            </div>
                                        </q-card-section>

                                    </q-card>
                                </q-dialog>
                            </div>
                            <div class="col-xl-11 col-lg-11 col-md-11 q-px-md">

                              <div class="row q-gutter-xl">
                                  <div class="col-auto">
                                      <span class="profile-title text-grey-8">نام کامل : </span>
                                      <span class="profile-text q-ml-xs">مهدی کرد</span>
                                  </div>

                              </div>

                            </div>
                        </div>
                    </q-card-section>
                </q-card>

            </div>
        </div>

    </template>


</template>

<style scoped>
.head-title{
    font-size: 16px;
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
</style>
