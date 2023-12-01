<script>
import {mapActions} from "vuex";
import Num2persian from 'num2persian';

export default {
    name: "Front_Profile_Provider_Implements",
    mounted() {
        if (this.AuthUserCheck()){
            this.GetUserImplement();
        }


    },
    data(){
        return {
            AddImplementDialog:false,
            user_implements:[],
            user_implement_loading:true,
            implement_loading:false,
            forms_loading:false,
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
            errors:[],

        }
    },
    methods : {
        ...mapActions([
            "ImplementsCategoriesSelectIndex",
            "ImplementsSelectIndex",
            "ImplementsShow",
            "ProfilesUserImplementStore",
            "ProfilesUserImplement",
            "ProfilesUserImplementDelete",
            "ProfilesUserImplementUpdate",
        ]),

        GetUserImplement(){
            this.ProfilesUserImplement().then(res => {
                this.user_implements = res.data.result;
                this.user_implement_loading=false;
            }).catch(error => {
                this.user_implement_loading=false;
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
        <div class="col-lg-9 col-sm-12 col-xs-12">
            <div>
                <q-img class="search-img" src="/front/images/tractor.png"></q-img>
                <strong class="text-green-7 title q-ml-sm">
                    اطلاعات مربوط به ادوات قابل ارائه
                </strong>
                <p class="text-justify q-mt-sm subtitle text-grey-8">
                    لیست خدماتی که توسط شما با مبلغ تعیین شده قابل ارائه است . توجه داشته باشید مبلغ های تعیین شده کمتر نسبت به دیگر ارائه دهندگان خدمات شانش بیشتری برای انتخاب شدن دارند
                </p>
            </div>
            <div class="text-right">
                <q-btn :to="{name : 'profile_provider'}" color="red" size="sm" class="font-12" icon-right="fas fa-arrow-left q-ml-xs" glossy >بازگشت</q-btn>
            </div>
            <global_info_loading class="q-mt-xl" v-if="user_implement_loading"></global_info_loading>

            <q-card v-else class="q-mt-md">
                <q-card-section>
                    <div class="info-subtitle text-red">
                        خدمات قابل ارائه توسط شما :
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
                                            type="number"
                                            v-model="price"
                                            color="green-7"
                                        >
                                        </q-input>
                                        <div>
                                            {{ this.$filters.numtopersian(price) }}
                                        </div>
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
                                    <span class="text-indigo implement-info">
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
                                                                        type="number"
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

}

</style>
