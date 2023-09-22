<script>
import {mapActions} from "vuex";

export default {
    name: "Manage_Users_Members_Details",
    mounted() {
      this.GetUser();
      this.GetCustomer();
      this.GetProvider();
      this.GetInvoices();
    },
    data(){
        return{
            loading_user:true,
            loading_user_customer:true,
            loading_user_provider:true,
            loading_user_invoices:true,
            user:null,
            customers:null,
            providers:null,
            invoices:[],
            item_columns:[
                {
                    name:'title',
                    required: true,
                    label: 'عنوان',
                    align: 'left',
                    field: row => row.title,
                    sortable: true
                },
                {
                    name:'code',
                    required: true,
                    label: 'کد فاکتور',
                    align: 'left',
                    field: row => row.code,
                    sortable: true
                },
                {
                    name:'price',
                    required: true,
                    label: 'مبلغ',
                    align: 'left',
                    field: row => row.price,
                    sortable: true
                },
                {
                    name:'is_pay',
                    required: true,
                    label: 'وضعیت پرداخت',
                    align: 'left',
                    field: row => row.is_pay,
                    sortable: true
                },
                {
                    name:'type',
                    required: true,
                    label: 'نوع فاکتور',
                    align: 'left',
                    field: row => row,
                    sortable: true
                },
                {
                    name:'status',
                    required: true,
                    label: 'وضعیت',
                    align: 'left',
                    field: row => row,
                    sortable: true
                },
                {
                    name:'tools',
                    required: true,
                    label: 'تنظیمات',
                    align: 'left',
                },
            ],
            dialog_detail:[],
            dialog_add:false,
            plan_selection:[
                {
                    label:'اشتراک خدمات گیرنده',
                    value:'customer'
                },
                {
                    label:'اشتراک خدمات دهنده',
                    value:'provider'
                },
            ],
            plans:[],
            add:{
              plan_type:null,
                plan_id:null,
            },


        }
    },
    methods:{
        ...mapActions([
            "UserMembersShow",
            "UserMembersActiveCustomer",
            "UserMembersActiveProvider",
            "UserMembersInvoices",
            "InvoicesChangePay",
            "PlansCustomerSelection",
            "PlansProviderSelection"
        ]),
        GetUser(){
            this.UserMembersShow(this.$route.params.id).then(res =>{
                this.user = res.data.result;
                this.loading_user=false;
            }).catch(error =>{
                return this.NotifyServerError();
            })
        },
        GetCustomer(){
            this.UserMembersActiveCustomer(this.$route.params.id).then(res =>{
                this.customers = res.data.result;
                this.loading_user_customer=false;
            }).catch(error =>{
                return this.NotifyServerError();
            })
        },
        GetProvider(){
            this.UserMembersActiveProvider(this.$route.params.id).then(res =>{
                this.providers = res.data.result;
                this.loading_user_provider=false;
            }).catch(error =>{
                return this.NotifyServerError();
            })
        },
        GetInvoices(){
            this.UserMembersInvoices(this.$route.params.id).then(res =>{
                this.invoices = res.data.result;
                this.loading_user_invoices=false;
            }).catch(error =>{
                return this.NotifyServerError();
            })
        },
        ChangePay(id) {
            this.$q.dialog({
                title: 'هشدار !',
                message: 'آیا مطمئن هستید وضعیت پرداخت تغییر کند ؟',

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
                this.InvoicesChangePay(id).then(res => {
                    this.invoices = this.invoices.filter(item =>{
                        if (item.id === id){
                            item.is_pay = !item.is_pay;
                            item.paid_at = res.data.result.paid_at;
                        }
                        return item
                    })
                    return this.NotifySuccess(res.data.message);
                }).catch(error => {
                    return  this.NotifyServerError();
                })

            }).onCancel(() => {
                // console.log('>>>> Cancel')
            }).onDismiss(() => {
                // console.log('I am triggered on both OK and Cancel')
            })
        },

    },
    computed:{
        GetPlansSelection(){
            if (this.add.plan_type === 'customer'){
                this.PlansCustomerSelection().then(res=>{
                    this.plans = res;
                } ).catch(error =>{
                    return  this.NotifyServerError();
                })
            }
            if (this.add.plan_type === 'provider'){
                this.PlansProviderSelection().then(res=>{
                    this.plans = res;
                } ).catch(error =>{
                    return  this.NotifyServerError();
                })
            }


        },


    }

}
</script>

<template>

    <strong v-if="!loading_user">
        مدیریت حساب کاربری : <span class="text-red">{{user.name}}</span>
    </strong>
    <div class="q-mt-lg row">
        <div class="col-md-4 q-px-sm">
            <q-card>
                <q-card-section v-if="loading_user">
                    <Global_Loading></Global_Loading>
                </q-card-section>
                <q-card-section v-else>
                    <q-avatar size="60px">
                        <q-img v-if="user.profile" :src="user.profile"></q-img>
                        <q-img v-else src="/assets/images/icons/user.png"></q-img>
                    </q-avatar>
                    <strong class="q-ml-sm">{{user.name}}</strong>
                    <q-chip square class="q-ml-sm" color="indigo" text-color="white">{{user.phone}}</q-chip>
                    <q-separator class="q-mt-md"/>
                    <div class="q-my-md">
                        <span class="text-grey-7">کد ملی :</span>
                        <strong class="text-indigo q-ml-sm">{{user.national_code}}</strong>
                    </div>
                    <q-separator/>
                    <div class="q-my-md">
                        <span class="text-grey-7">استان :</span>
                        <strong v-if="user.province" class="text-indigo q-ml-sm">{{user.province.name}}</strong>
                    </div>
                    <q-separator/>
                    <div class="q-my-md">
                        <span class="text-grey-7">شهر :</span>
                        <strong v-if="user.city" class="text-indigo q-ml-sm">{{user.city.name}}</strong>
                    </div>
                    <q-separator/>
                    <div class="q-my-md">
                        <span class="text-grey-7">تعداد زیرگروه :</span>
                        <strong class="text-indigo q-ml-sm">{{user.referrals_count}}</strong>
                    </div>
                    <q-separator/>

                    <div class="q-my-md">
                        <span class="text-grey-7">درباره کاربر :</span>
                        <strong class="text-indigo q-ml-sm">{{user.bio}}</strong>
                    </div>
                    <q-separator/>
                    <div class="q-my-sm">
                        <span class="text-grey-7">وضعیت حساب :</span>
                        <q-chip v-if="user.is_active" class="font-13" color="positive" text-color="white" icon="mdi-check">فعال</q-chip>
                        <q-chip v-else class="font-13" color="red" text-color="white" icon="mdi-close">غیر فعال</q-chip>
                    </div>
                </q-card-section>
            </q-card>
        </div>
        <div class="col-md-4 q-px-sm">
            <q-card>
                <q-card-section>
                    <strong class="text-teal-8 font-15">
                        اشتراک فعال خدمات گیرنده
                    </strong>
                    <q-separator class="q-mt-sm"/>
                </q-card-section>
                <q-card-section v-if="loading_user_customer" class="q-py-xs">
                    <Global_Loading></Global_Loading>
                </q-card-section>
                <q-card-section v-else>
                    <div v-if="!customers" class="q-mt-md q-mb-lg text-center">
                        <strong class="text-red">
                            اشتراک خدمات گیرنده برای کاربر فعال نیست
                        </strong>
                    </div>
                    <div v-else>
                        <div class="q-mb-md">
                            <span class="text-grey-7">اشتراک :</span>
                            <strong class="text-blue-9 q-ml-sm">{{customers.title}}</strong>
                        </div>
                        <q-separator/>
                        <div class="q-my-md">
                            <span class="text-grey-7">مدت اشتراک :</span>
                            <strong class="q-ml-sm">{{customers.access}} ماه</strong>
                        </div>
                        <q-separator/>
                        <div class="q-my-sm">
                            <span class="text-grey-7">تاریخ فعالسازی :</span>
                            <q-chip class="q-ml-sm font-12" color="positive" text-color="white">{{this.$filters.date(customers.start_at)}}</q-chip>
                        </div>
                        <q-separator/>
                        <div class="q-my-sm">
                            <span class="text-grey-7">تاریخ اتمام :</span>
                            <q-chip class="q-ml-sm font-12" color="red" text-color="white">{{this.$filters.date(customers.end_at)}}</q-chip>
                        </div>
                        <q-separator/>
                        <div class="q-my-md">
                            <span class="text-grey-7">مبلغ پرداختی :</span>
                            <strong class="q-ml-sm text-green-7">{{this.$filters.numbers(customers.invoice.price)}}</strong>
                        </div>
                        <q-separator/>
                        <div class="q-my-md">
                            <span class="text-grey-7">کد فاکتور :</span>
                            <strong class="q-ml-sm">{{customers.invoice.code}}</strong>
                        </div>
                        <q-separator/>
                        <div class="q-my-md">
                            <span class="text-grey-7">تاریخ فاکتور :</span>
                            <strong class="q-ml-sm">{{this.$filters.date(customers.invoice.created_at)}}</strong>
                        </div>
                    </div>
                </q-card-section>

            </q-card>
        </div>
        <div class="col-md-4 q-px-sm">
            <q-card>
                <q-card-section>
                    <strong class="text-accent font-15">
                        اشتراک فعال خدمات دهنده
                    </strong>
                    <q-separator class="q-mt-sm"/>
                </q-card-section>
                <q-card-section v-if="loading_user_provider" class="q-py-xs">
                    <Global_Loading></Global_Loading>
                </q-card-section>
                <q-card-section v-else>
                    <div v-if="!providers" class="q-mt-md q-mb-lg text-center">
                        <strong class="text-red">
                            اشتراک خدمات دهنده برای کاربر فعال نیست
                        </strong>
                    </div>
                    <div v-else>
                        <div class="q-mb-md">
                            <span class="text-grey-7">اشتراک :</span>
                            <strong class="text-blue-9 q-ml-sm">{{providers.title}}</strong>
                        </div>
                        <q-separator/>
                        <div class="q-my-md">
                            <span class="text-grey-7">مدت اشتراک :</span>
                            <strong class="q-ml-sm">{{providers.access}} ماه</strong>
                        </div>
                        <q-separator/>
                        <div class="q-my-sm">
                            <span class="text-grey-7">تاریخ فعالسازی :</span>
                            <q-chip class="q-ml-sm font-12" color="positive" text-color="white">{{this.$filters.date(providers.start_at)}}</q-chip>
                        </div>
                        <q-separator/>
                        <div class="q-my-sm">
                            <span class="text-grey-7">تاریخ اتمام :</span>
                            <q-chip class="q-ml-sm font-12" color="red" text-color="white">{{this.$filters.date(providers.end_at)}}</q-chip>
                        </div>
                        <q-separator/>
                        <div class="q-my-md">
                            <span class="text-grey-7">مبلغ پرداختی :</span>
                            <strong class="q-ml-sm text-green-7">{{this.$filters.numbers(providers.invoice.price)}}</strong>
                        </div>
                        <q-separator/>
                        <div class="q-my-md">
                            <span class="text-grey-7">کد فاکتور :</span>
                            <strong class="q-ml-sm">{{providers.invoice.code}}</strong>
                        </div>
                        <q-separator/>
                        <div class="q-my-md">
                            <span class="text-grey-7">تاریخ فاکتور :</span>
                            <strong class="q-ml-sm">{{this.$filters.date(providers.invoice.created_at)}}</strong>
                        </div>
                    </div>
                </q-card-section>

            </q-card>
        </div>
         <div class="col-12 q-mt-lg q-px-sm">
             <q-card>
                 <q-card-section class="bg-indigo text-white">
                     <strong class="font-16">لیست فاکتور ها و اشتراک های کاربر</strong>
                     <q-btn @click="dialog_add=true" class="float-right q-mb-sm" color="white" text-color="dark" glossy icon="mdi-plus-circle q-mr-xs">افزودن اشتراک</q-btn>
                     <q-dialog
                         v-model="dialog_add"
                         transition-show="scale"
                         transition-hide="scale"
                         position="top"
                     >
                         <q-card style="max-width: 960px;width: 700px">
                             <q-card-section class="bg-deep-purple text-white">
                                 <strong class="font-16">
                                     افزودن اشتراک جدید برای کاربر
                                 </strong>
                             </q-card-section>
                             <q-card-section >
                                 <q-banner class="bg-yellow-8 text-dark">
                                     اگر کاربر اشتراک فعالی داشته باشد، اشتراک جدید به صورت رزرو شده ثبت میشود
                                 </q-banner>
                                 <q-select
                                     outlined
                                     color="primary"
                                     class="q-mt-lg"
                                     transition-show="flip-up"
                                     transition-hide="flip-down"
                                     v-model="add.plan_type"
                                     use-input
                                     label="انتخاب نوع اشتراک"
                                     :options="plan_selection"
                                     emit-value
                                     map-options
                                     @change="GetPlansSelection"
                                     behavior="menu"
                                 >
                                     <template v-slot:no-option>
                                         <q-item>
                                             <q-item-section class="text-red">
                                                 گزینه ای یافت نشد
                                             </q-item-section>
                                         </q-item>
                                     </template>
                                     <template v-slot:error>
                                     </template>
                                 </q-select>
                                 <q-select
                                     outlined
                                     color="primary"
                                     class="q-mt-lg"
                                     transition-show="flip-up"
                                     transition-hide="flip-down"
                                     v-model="add.plan_id"
                                     use-input
                                     label="انتخاب اشتراک"
                                     :options="plans"
                                     emit-value
                                     map-options
                                     behavior="menu"
                                 >
                                     <template v-slot:no-option>
                                         <q-item>
                                             <q-item-section class="text-red">
                                                 گزینه ای یافت نشد
                                             </q-item-section>
                                         </q-item>
                                     </template>
                                     <template v-slot:error>
                                     </template>
                                 </q-select>


                             </q-card-section>
                             <q-card-actions align="right">
                                 <q-btn glossy label="ثبت اشتراک جدید" color="positive"  />

                                 <q-btn glossy label="بستن" color="red" v-close-popup />
                             </q-card-actions>
                         </q-card>

                     </q-dialog>


                 </q-card-section>
                 <q-card-section class="q-px-none q-pb-none">
                     <q-banner v-if="!invoices.length" class="bg-yellow-9 text-dark text-center">
                         هیچ فاکتوری بری این کاربر ثبت نشده است
                     </q-banner>
                     <template v-else>
                         <q-table
                             :rows="invoices"
                             row-key="id"
                             :columns="item_columns"
                             color="indigo"
                             table-header-class="text-indigo"
                             separator="cell"
                             :pagination="{rowsPerPage:10}"
                         >
                             <template v-slot:body-cell-code="props">
                                 <q-td :props="props">
                                     <q-chip class="font-12" color="red" text-color="white">{{props.row.code}}</q-chip>
                                 </q-td>
                             </template>

                             <template v-slot:body-cell-price="props">
                                 <q-td :props="props">
                                     <strong class="text-green-7 font-14">{{this.$filters.numbers(props.row.price)}}</strong>
                                 </q-td>
                             </template>
                             <template v-slot:body-cell-is_pay="props">
                                 <q-td :props="props">
                                     <q-btn rounded glossy @click="ChangePay(props.row.id)" class="font-12" dense v-if="props.row.is_pay" color="positive" icon="mdi-check">پرداخت شده</q-btn>
                                     <q-btn rounded glossy @click="ChangePay(props.row.id)" class="font-12" dense v-else color="red" icon="mdi-close">پرداخت نشده</q-btn>
                                 </q-td>
                             </template>
                             <template v-slot:body-cell-type="props">
                                 <q-td :props="props">
                                     <q-chip class="font-12" v-if="props.row.plan_type === 'provider'" color="deep-purple-7" text-color="white" >اشتراک خدمات دهنده</q-chip>
                                     <q-chip class="font-12" v-else-if="props.row.plan_type === 'customer'" color="deep-orange" text-color="white" > اشتراک خدمات گیرنده</q-chip>
                                     <q-chip class="font-12" v-else color="indigo-7" text-color="white" >خرید از فروشگاه</q-chip>
                                 </q-td>
                             </template>
                             <template v-slot:body-cell-status="props">
                                 <q-td :props="props">
                                     <q-chip v-if="props.row.provider_plan && props.row.provider_plan.is_active || props.row.customer_plan && props.row.customer_plan.is_active" class="font-13" color="positive" text-color="white" icon="mdi-check-circle">فعال</q-chip>
                                     <q-chip v-if="props.row.provider_plan && props.row.provider_plan.is_end || props.row.customer_plan && props.row.customer_plan.is_end"  class="font-13" color="dark" text-color="white" icon="mdi-close-circle">اتمام</q-chip>
                                     <q-chip v-if="props.row.provider_plan && props.row.provider_plan.reserved || props.row.customer_plan && props.row.customer_plan.reserved"  class="font-13" color="yellow-9" text-color="dark" icon="mdi-progress-clock">رزرو شده</q-chip>
                                 </q-td>
                             </template>
                             <template v-slot:body-cell-tools="props">
                                 <q-td :props="props">
                                     <q-btn @click="dialog_detail[props.row.id] = true" glossy color="teal" size="sm" icon="mdi-menu" class="q-mx-xs">
                                         <q-tooltip class="bg-grey-9">جزئیات کامل</q-tooltip>
                                     </q-btn>

                                     <q-dialog
                                         v-model="dialog_detail[props.row.id]"
                                         transition-show="scale"
                                         transition-hide="scale"
                                         position="top"
                                     >
                                         <q-card style="max-width: 700px;width: 700px">
                                             <q-card-section class="bg-teal-7 text-white">
                                                 <strong>مشاهده جزئیات کامل : {{props.row.code}}</strong>
                                             </q-card-section>
                                             <q-card-section >
                                                 <q-banner v-if="props.row.is_free" class="bg-yellow-9 text-dark q-mb-md text-center" rounded>
                                                     این فاکتور به صورت رایگان است
                                                 </q-banner>
                                                 <div class="q-mb-md">
                                                     <strong class="text-red-5">عنوان فاکتور : </strong>
                                                     <span>{{props.row.title}}</span>
                                                 </div>
                                                 <q-separator/>
                                                 <div class="q-mt-md">
                                                     <strong class="text-indigo-7">اطلاعات کاربر : </strong>
                                                 </div>
                                                 <div v-if="!loading_user" class="q-mt-md row">
                                                     <div class="col-md-6 q-mb-md">
                                                         <strong class="text-teal-7">نام کامل : </strong>
                                                         <span>{{user.name}}</span>
                                                     </div>
                                                     <div class="col-md-6 q-mb-md">
                                                         <strong class="text-teal-7">شماره موبایل : </strong>
                                                         <span>{{user.phone}}</span>
                                                     </div>
                                                     <div class="col-md-6 q-mb-md">
                                                         <strong class="text-teal-7">کد ملی : </strong>
                                                         <span>{{user.national_code}}</span>
                                                     </div>
                                                 </div>
                                                 <q-separator/>
                                                 <div class="q-mt-md">
                                                     <strong class="text-indigo-7">اطلاعات تراکنش و مبلغ : </strong>
                                                 </div>
                                                 <div class="q-mt-md q-mb-sm row">
                                                     <div class="col-md-6 q-mb-md">
                                                         <strong class="text-teal-7"> مبلغ فاکتور : </strong>
                                                         <strong class="text-green-7">{{this.$filters.numbers(props.row.price)}}</strong>
                                                     </div>
                                                     <div class="col-md-6 q-mb-md">
                                                         <strong class="text-teal-7">وضعیت پرداخت : </strong>
                                                         <strong v-if="props.row.is_pay" class="text-positive">
                                                             <q-icon name="mdi-check font-20" />
                                                             پرداخت شده
                                                         </strong>
                                                         <strong v-else class="text-red">
                                                             <q-icon name="mdi-close font-20" />
                                                             پرداخت نشده
                                                         </strong>
                                                     </div>
                                                     <div class="col-md-6 q-mb-md">
                                                         <strong class="text-teal-7">ثبت توسط : </strong>
                                                         <template v-if="props.row.admin_id">
                                                             <span>مدیریت : </span>
                                                             <span>{{props.row.admin.name}}</span>
                                                         </template>
                                                         <span v-else> کاربر</span>
                                                     </div>
                                                     <div class="col-md-6 q-mb-md">
                                                         <strong class="text-teal-7">درگاه پرداخت : </strong>
                                                         <span>{{ props.row.gateway }}</span>
                                                     </div>
                                                     <template v-if="props.row.is_pay">
                                                         <div class="col-md-6 q-mb-md">
                                                             <strong class="text-teal-7"> زمان پرداخت : </strong>
                                                             <span>{{this.$filters.date(props.row.paid_at)}}</span>
                                                         </div>
                                                         <div class="col-md-6 q-mb-md">
                                                             <strong class="text-teal-7"> کد تراکنش بانکی : </strong>
                                                             <span>{{props.row.ref_id}}</span>
                                                         </div>

                                                     </template>

                                                 </div>
                                                 <q-separator/>
                                                 <div class="q-mt-md">
                                                     <strong class="text-indigo-7">اطلاعات محصول : </strong>
                                                 </div>
                                                 <div class="q-mt-md q-mb-sm row">

                                                     <div class="col-md-5 q-mb-md">
                                                         <strong class="text-teal-7">نوع : </strong>
                                                         <q-chip class="font-13" dense v-if="props.row.plan_type === 'provider'" color="blue-grey-7" text-color="white" >اشتراک خدمات دهنده</q-chip>
                                                         <q-chip class="font-13" dense v-else-if="props.row.plan_type === 'customer'" color="blue-grey-7" text-color="white" >اشتراک خدمات گیرنده</q-chip>
                                                         <q-chip class="font-13" dense v-else color="blue-grey-7" text-color="white" >خرید از فروشگاه</q-chip>
                                                     </div>
                                                     <div class="col-md-7 q-mb-md">
                                                         <strong class="text-teal-7">عنوان : </strong>
                                                         <span v-if="props.row.plan_type === 'provider' && props.row.provider_plan">
                                                {{props.row.provider_plan.title}}
                                            </span>
                                                         <span v-if="props.row.plan_type === 'customer' && props.row.customer_plan">
                                                {{props.row.customer_plan.title}}
                                            </span>
                                                     </div>

                                                 </div>

                                             </q-card-section>
                                             <q-card-actions align="right">
                                                 <q-btn  label="بستن" color="red" v-close-popup />
                                             </q-card-actions>
                                         </q-card>

                                     </q-dialog>

                                 </q-td>

                             </template>

                         </q-table>
                     </template>
                 </q-card-section>
             </q-card>

         </div>

    </div>

</template>

<style scoped>

</style>
