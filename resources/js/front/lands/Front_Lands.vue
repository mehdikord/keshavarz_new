<script>

import {mapActions} from "vuex";
import NeshanMap from "@neshan-maps-platform/vue3-openlayers";

export default {
    name: "Front_Lands",
    components: {NeshanMap},
    mounted() {
        this.GetItems();
    },
    data(){
      return{
          loading:true,
          add_loading:false,
          items:[],
          AddDialog:false,
          EditDialog:[],
          add:{
              title:null,
              description:null,
              area:null,
              image:null,
              location:[],

          },
          errors:[],

      }
    },
    methods :{
        ...mapActions([
            "LandsUserIndex",
            "LandsUserStore",
            "LandsUserEdit",
            "LandsUserDelete",
        ]),
        Map_Marker(e){
            if (e.coords){
                this.location = [];
                this.add.location.push(e.coords[1]);
                this.add.location.push(e.coords[0]);
            }
        },

        GetItems(){
            this.LandsUserIndex().then(res => {
                this.items = res.data.result;
                this.loading=false;
            }).catch(error =>{
                return this.NotifyServerError();
            })
        },

        AddItem(){
            if (!this.add.location.length){
                return this.NotifyError("موقعیت جغرافیایی انتخاب نشده است")
            }
            this.add.area = this.$filters.persianDigitsToEnglish(this.add.area)
            this.add_loading=true;
            this.LandsUserStore(this.add).then(res => {
                this.items.unshift(res.data.result);
                this.add_loading=false;
                this.add=[];
                this.AddDialog=false;
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
        DeleteItem(id){

            this.$q.dialog({
                title: 'هشدار !',
                message: 'آیا مطمئن هستید زمین مورد نظر حذف شود ؟',
                ok: {
                    push: true,
                    color:'green-9',
                },
                cancel: {
                    push: true,
                    color: 'negative'
                },
                persistent: true
            }).onOk(() => {
                this.LandsUserDelete(id).then(res => {
                    this.items = this.items.filter(item =>{
                        return item.id !== id;
                    })
                    return this.NotifyDelete();
                }).catch(error => {
                    return  this.NotifyServerError();
                })

            }).onCancel(() => {
                // console.log('>>>> Cancel')
            }).onDismiss(() => {
                // console.log('I am triggered on both OK and Cancel')
            })
        }


    }

}
</script>

<template>
    <div class="row justify-center">
        <div class="col-lg-9 col-sm-12 col-xs-12 ">
            <div class="q-mt-md">
                <q-img class="search-img" src="/front/images/lands.png"></q-img>
                <strong class="text-green-7 title q-ml-sm">
                    لیست زمین های من
                </strong>
                <p class="text-justify q-mt-md subtitle text-indigo">
                    کاربر گرامی در این صفحه شما میتوانید لیست زمین های کشاورزی خود را وارد کنید و برای دریافت خدمات کشاورزی به راحتی آن ها را مدیریت کنید.
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
                    <div>
                        <q-btn @click="AddDialog = true" class="add-btn" color="teal-8" text-color="white" rounded glossy icon="fas fa-plus q-mr-sm">افزودن زمین جدید</q-btn>
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
                                    <div  class="map q-mt-sm">
                                        <NeshanMap
                                            mapKey="web.eaf4d6d0f42a400bb9583fbd8496947f"
                                            :center="{ latitude: 36.83951508755615, longitude: 54.43313598632812 }"
                                            :zoom="10"
                                            hide-layers
                                            :hide-search-container="true"
                                            @on-click="Map_Marker"
                                        />
                                    </div>
                                    <div class="text-center q-mt-sm">
                                        <span>موقعیت جغرافیایی : </span>
                                        <strong v-if="!add.location.length" class="text-red"> انتخاب نشده</strong>
                                        <strong v-else class="text-positive"> انتخاب شده</strong>
                                    </div>

                                </q-card-section>
                                <div class="text-right q-mb-md q-px-md">
                                    <q-btn v-close-popup glossy color="red-7" class="q-mr-sm add-land-btn" icon-right="fas fa-times q-ml-xs">بستن</q-btn>

                                    <q-btn @click="AddItem" :loading="add_loading" glossy color="green-7" class="add-land-btn" icon-right="fas fa-check q-ml-xs">افزودن زمین</q-btn>
                                </div>

                            </q-card>

                        </q-dialog>

                        <q-separator class="q-mt-md q-mb-lg" />
                        <global_info_loading v-if="loading" class="q-mt-xl"></global_info_loading>
                        <div v-else>
                            <div v-if="!items.length" class="text-center">
                                <q-img src="/front/images/planet-earth.png" class="planet-image q-mt-lg" alt="" />
                                <h6 class="nodata text-deep-orange-9">
                                    شما هنوز هیچ زمینی برای خود اضافه نکرده اید
                                </h6>
                            </div>
                            <div v-else class="row">
                                <div v-for="item in items" class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                    <q-card class="q-mx-xs q-ma-xs">
                                        <div class="row">
                                            <div class="col-md-4 col-sm-4 col-xs-4">
                                                <q-img v-if="item.image" class="land-image" :src="item.image"></q-img>
                                                <q-img v-else class="land-image" src="/front/images/land-default.png"></q-img>
                                            </div>
                                            <div class="col-md-8 col-sm-8 col-xs-8 q-py-sm q-px-sm">
                                                <div class="q-mt-xs">
                                                    <strong class="text-indigo">{{item.title}}</strong>
                                                </div>
                                                <div class="q-mt-xs">
                                                    <span class="area-title text-grey-8">مساحت : </span>
                                                    <span class="area-value q-ml-xs text-red">44000</span>
                                                    <span class="q-ml-xs">متر</span>
                                                </div>
                                                <div class="q-mt-xs">
                                                    <span class="area-title text-grey-8">تعداد خدمات : </span>
                                                    <strong class="q-ml-xs text-teal-8">5</strong>
                                                </div>
                                                <div class="text-right">
                                                    <q-btn @click="EditDialog[item.id] = true" icon="fas fa-edit" class="font-10" glossy dense color="blue-8"></q-btn>
                                                    <q-dialog position="top" v-model="EditDialog[item.id]" >

                                                        <q-card class="add-land-card">
                                                            <q-card-section class="bg-blue-8 text-white">
                                                                <strong class="add-land-title">
                                                                   ویرایش زمین : {{item.title}}
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
                                                                <div  class="map q-mt-sm">
                                                                    <NeshanMap
                                                                        mapKey="web.eaf4d6d0f42a400bb9583fbd8496947f"
                                                                        :center="{ latitude: 36.83951508755615, longitude: 54.43313598632812 }"
                                                                        :zoom="10"
                                                                        hide-layers
                                                                        :hide-search-container="true"
                                                                        @on-click="Map_Marker"
                                                                    />
                                                                </div>
                                                                <div class="text-center q-mt-sm">
                                                                    <span>موقعیت جغرافیایی : </span>
                                                                    <strong v-if="!add.location.length" class="text-red"> انتخاب نشده</strong>
                                                                    <strong v-else class="text-positive"> انتخاب شده</strong>
                                                                </div>

                                                            </q-card-section>
                                                            <div class="text-right q-mb-md q-px-md">
                                                                <q-btn v-close-popup glossy color="red-7" class="q-mr-sm add-land-btn" icon-right="fas fa-times q-ml-xs">بستن</q-btn>

                                                                <q-btn @click="AddItem" :loading="add_loading" glossy color="green-7" class="add-land-btn" icon-right="fas fa-check q-ml-xs">افزودن زمین</q-btn>
                                                            </div>

                                                        </q-card>

                                                    </q-dialog>


                                                    <q-btn @click="DeleteItem(item.id)" icon="fas fa-trash" class="font-10" glossy dense color="red q-ml-sm" ></q-btn>
                                                </div>
                                            </div>
                                        </div>
                                    </q-card>
                                </div>

                            </div>



                        </div>


                    </div>



                </template>
            </div>
        </div>
    </div>
</template>

<style scoped>

.land-image{
    width: 120px;
    height: 120px;
    max-width: 100%!important;
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
.add-btn{
    font-size: 15px;
}
.planet-image{
    width: 130px;
}
.nodata{
    font-size: 17px;
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
    height: 400px;
}
.area-title{
    font-size: 13px;
    font-weight: 450;
}
.area-value{
    font-size: 16px;
    font-weight: 600;
}
@media only screen and (max-width: 600px) {
    .land-image{
        width: 100px;
        height: 100px;
        max-width: 100%!important;
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
    .add-btn{
        font-size: 13px;
    }
    .planet-image{
        width: 100px;
    }
    .nodata{
        font-size: 14px;
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
    .area-title{
        font-size: 12px;
        font-weight: 450;
    }
    .area-value{
        font-size: 15px;
        font-weight: 600;
    }
}
</style>
