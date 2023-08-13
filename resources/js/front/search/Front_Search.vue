<script>
import {mapActions} from "vuex";
import NeshanMap from "@neshan-maps-platform/vue3-openlayers"
import Front_Search_Profile from "@/front/search/Front_Search_Profile.vue";

export default {
    name: "Front_Search",
    mounted() {
      this.Get_Categories();
      this.Get_Implements();
    },
    components: {
        NeshanMap,
        'search_profile' : Front_Search_Profile,

    },
    data(){
        return{
            errors:[],
            show_form:true,
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
        }
    },

    methods:{
        ...mapActions([
            "ImplementsCategoriesSelectIndex",
            "ImplementsSelectIndex"

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
            if (!this.location.length){
                return this.NotifyError("مختصات از نقشه انتخاب نشده")
            }
            if (!this.implement_id){
                return this.NotifyError("ادوات برای جستجو انتخاب نشده")
            }
            // this.search_loading=true;
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
                this.location.push(e.coords[1]);
                this.location.push(e.coords[0]);
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
        }
    }
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
            <div class="q-mt-xl">
                <template v-if="show_form">
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
                            use-input
                            label="انتخاب ادوات"
                            :options="implements"
                            emit-value
                            map-options
                            @filter="Filter_Select_Implement"
                            :loading="loading_select_implements"
                            behavior="menu"
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
                                   :center="{ latitude: 35.70222201840939, longitude: 51.35178336960962 }"
                                   :zoom="10"
                                   hide-layers
                                   :hide-search-container="true"
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
                </template>
                <template v-else>
                    <div>
                        <span class="result-title q-mr-sm">نتایج جستجو برای : </span>
                        <span class="result-info text-red">{{category_name}}</span> / <span class="result-info text-red">{{implement_name}}</span>
                        <q-btn @click="category_id=null;implement_id=null;show_form=true" class="float-right research" color="deep-orange" rounded icon="fas fa-search q-mr-sm"> جستجو مجدد </q-btn>
                    </div>
                    <div class="q-mt-lg">
                        <q-separator></q-separator>
                    </div>
                    <div class="q-mt-xl">
                        <global_search_loading v-if="search_loading"></global_search_loading>
                        <template v-else>
                            <div class="q-mb-md search-text text-indigo">
                                13 کاربر برای ارائه این خدمت یافت شد
                            </div>
                            <search_profile v-for="i in 7" class="q-mb-md"></search_profile>
                        </template>



                    </div>

                </template>

            </div>


        </div>
    </div>

</template>

<style scoped>
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

@media only screen and (max-width: 600px) {

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

}
</style>
