<script>

import {mapActions} from "vuex";

export default {
    name: "Front_Lands",
    mounted() {
        this.GetItems();
    },
    data(){
      return{
          loading:true,
          items:[],
          AddDialog:false,
          add:{
              title:null,
              description:null,
              area:null,
              image:null,
          }

      }
    },
    methods :{
        ...mapActions([
            "LandsUserIndex",
            "LandsUserStore",
            "LandsUserEdit",
            "LandsUserDelete",
        ]),

        GetItems(){
            this.LandsUserIndex().then(res => {
                this.items = res.data.result;
                this.loading=false;
            }).catch(error =>{
                return this.NotifyServerError();
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
                                        class="q-mb-lg"
                                    >
                                    </q-input>
                                    <q-input
                                        label="مساحت زمین ( به مترمربع )"
                                        outlined
                                        v-model="add.area"
                                        color="green-8"
                                    >
                                    </q-input>



                                </q-card-section>

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

                            </div>



                        </div>


                    </div>



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

}
</style>
