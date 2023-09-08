<script>
import {mapActions} from "vuex";

export default {
    name: "Front_Implement_Request",
    data(){
        return{
            req:{
                type:null,
                name:null,
                image:null,
                description:null,
            },
            loading:false,
            authDialog:false,
            errors:[],
        }
    },
    methods:{
        ...mapActions([
            "ProfilesUserImplementRequest",
        ]),
        SendData(){
            if (!this.AuthUserCheck()){
                return this.authDialog=true;
            }
            this.loading=true;
            this.ProfilesUserImplementRequest(this.req).then(res => {
                this.loading=false;
                this.req=[];
                return this.NotifySuccess(res.data.message);
            }).catch(error => {
                this.edit_image_loading=false;
                if (error.response.status === 422) {
                    this.errors = error.response.data
                }else {
                    return this.NotifyServerError();
                }
            })

        }
    }
}
</script>

<template>
    <div class="row justify-center">
        <div class="col-lg-9 col-sm-12 col-xs-12 ">
            <div class="q-mt-md">
                <q-img class="search-img" src="/front/images/implement-req.png"></q-img>
                <strong class="text-green-7 title q-ml-sm">
                    درخواست ثبت ادوات جدید
                </strong>
                <p class="text-justify q-mt-md subtitle">
                    کاربر عزیز کشاورز اگر در بین لیست ادوات کشاورزی دستگاه مورد نظر خورد را پیدا نکردید
                    <br>
                    میتوانید از طریق این فرم اطلاعات دستگاه و یا خدمت را برای ما ارسال کنید و تیم کشاورز در اسراع وقت دستگاه مورد نظر را به لیست ادوات برنامه اضافه خواهد کرد.
                    <br>
                    تیم توسعه کشاورز .
                </p>
            </div>
            <q-separator/>
            <div class="q-mt-xl row justify-center">

                <div class="col-xl-10 col-lg-10 col-md-11 col-sm-12 col-xs-12">
                    <div class="q-mb-xl form-title text-red">
                        برای ثبت ادوات جدید لطفا فرم زیر را کامل کنید
                    </div>
                    <div class="q-mb-sm">
                        <q-input v-model="req.type"  outlined color="green-7" label="نوع استفاده دستگاه ( مثال : ادوات برداشت )" :error="this.MixinValidationCheck(errors,'type')">
                            <template v-slot:error>
                                <Error_Validation :errors="this.MixinValidation(errors,'type')"></Error_Validation>
                            </template>
                        </q-input>
                    </div>
                    <div class="q-mb-sm">
                        <q-input v-model="req.name"  outlined color="green-7" label="نام کامل دستگاه " :error="this.MixinValidationCheck(errors,'name')">
                            <template v-slot:error>
                                <Error_Validation :errors="this.MixinValidation(errors,'name')"></Error_Validation>
                            </template>
                        </q-input>
                    </div>
                    <div class="q-mb-sm">
                        <q-file outlined v-model="req.image" label="تصویر دستگاه ( اختیاری )" :error="this.MixinValidationCheck(errors,'image')">
                            <template v-slot:prepend>
                                <q-icon name="fas fa-image" />
                            </template>
                            <template v-slot:error>
                                <Error_Validation :errors="this.MixinValidation(errors,'image')"></Error_Validation>
                            </template>
                        </q-file>
                    </div>
                    <div class="q-mb-sm">
                        <q-input v-model="req.description" type="textarea" outlined color="green-7" label="توضیحات بیشتر ( اختیاری ) " :error="this.MixinValidationCheck(errors,'description')">
                            <template v-slot:error>
                                <Error_Validation :errors="this.MixinValidation(errors,'description')"></Error_Validation>
                            </template>
                        </q-input>
                    </div>
                    <div class="q-mt-md text-center q-mb-lg">
                        <q-btn @click="SendData" :loading="loading" color="green-7" glossy class="submit">ثبت و ارسال اطلاعات</q-btn>

                        <q-dialog  v-model="authDialog">
                            <q-card class="image-dialog">
                                <q-card-section>
                                    <div class="text-center">
                                        <q-icon name="fas fa-triangle-exclamation fa-3x fa-beat text-red"></q-icon>
                                    </div>
                                    <div class="text-center q-mt-lg text-red q-mb-md">
                                        <strong>کاربر گرامی برای درخواست ثبت ادوات ابتدا باید وارد حساب کاربری خود شوید</strong>
                                        <q-btn :to="{name:'profile'}" class="q-mt-lg" glossy color="teal-7">ثبت نام / ورود به حساب کاربری</q-btn>
                                    </div>

                                </q-card-section>

                            </q-card>
                        </q-dialog>

                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<style scoped>
.title{
    font-size: 19px;
}
.search-img{
    width: 100px;
}
.subtitle{
    font-size: 16px;
}
.form-title{
    font-size: 16px;
    font-weight: 600;
}
.submit{
    font-size: 15px;
}

@media only screen and (max-width: 600px) {
    .title{
        font-size: 17px;
    }
    .search-img{
        width: 90px;
    }
    .subtitle{
        font-size: 14px;
    }
    .form-title{
        font-size: 14px;
        font-weight: 600;
    }
    .submit{
        font-size: 14px;
    }
}
</style>
