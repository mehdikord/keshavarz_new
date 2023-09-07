<template>
    <q-card flat bordered>

        <q-card-section class="bg-blue-grey-14 text-white q-pb-lg">
            <strong class="font-16">امور مالی و فاکتور ها</strong>
        </q-card-section>

        <q-card-section>

            <q-banner class="q-mb-md bg-indigo text-white" >
                <q-icon name="mdi-information font-24"></q-icon>
                برای تغییر وضعیت پرداخت فاکتور روی دکمه وضعیت پرداخت کلیک کنید و برای مشاهد جزئیات کامل فاکتور دکمه جزئیات را در قسمت تنظیمات کلیک کنید
            </q-banner>
            <q-table
                :rows="items"
                row-key="id"
                :columns="item_columns"
                color="indigo"
                table-header-class="text-indigo"
                :loading="loading_get"
                separator="cell"
                :pagination="{rowsPerPage:30}"
            >
                <template v-slot:loading>
                    <Global_Loading></Global_Loading>
                </template>
                <template v-slot:body-cell-user="props">
                    <q-td :props="props">
                        <Global_Show_Image :image="props.row.user.profile"></Global_Show_Image>

                        <strong class="text-indigo-8 q-ml-sm">
                            {{props.row.user.name}}
                        </strong>
                    </q-td>
                </template>
                <template v-slot:body-cell-implement="props">
                    <q-td :props="props">
                        <strong class="text-red">
                            {{props.row.implement.name}}
                        </strong>
                    </q-td>
                </template>
                <template v-slot:body-cell-price="props">
                    <q-td :props="props">
                        <strong class="text-green-7">{{this.$filters.numbers(props.row.price)}}</strong>
                    </q-td>
                </template>
                <template v-slot:body-cell-is_pay="props">
                    <q-td :props="props">
                        <q-btn class="font-12" dense v-if="props.row.is_pay" color="positive" icon="mdi-check">پرداخت شده</q-btn>
                        <q-btn class="font-12" dense v-else color="red" icon="mdi-close">پرداخت نشده</q-btn>
                    </q-td>
                </template>
                <template v-slot:body-cell-type="props">
                    <q-td :props="props">
                        <q-chip dense v-if="props.row.plan_type === 'provider'" color="deep-orange-7" text-color="white" >اشتراک خدمات گیرنده</q-chip>
                        <q-chip dense v-else-if="props.row.plan_type === 'customer'" color="green-7" text-color="white" >اشتراک خدمات دهنده</q-chip>
                        <q-chip dense v-else color="indigo-7" text-color="white" >خرید از فروشگاه</q-chip>
                    </q-td>
                </template>
                <template v-slot:body-cell-method="props">
                    <q-td :props="props">
                        <q-chip dense color="deep-purple" text-color="white">{{props.row.method}}</q-chip>
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
                                    <div class="q-mt-md row">
                                        <div class="col-md-6 q-mb-md">
                                            <strong class="text-teal-7">نام کامل : </strong>
                                            <span>{{props.row.user.name}}</span>
                                        </div>
                                        <div class="col-md-6 q-mb-md">
                                            <strong class="text-teal-7">شماره موبایل : </strong>
                                            <span>{{props.row.user.phone}}</span>
                                        </div>
                                        <div class="col-md-6 q-mb-md">
                                            <strong class="text-teal-7">کد ملی : </strong>
                                            <span>{{props.row.user.national_code}}</span>
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
                                            <strong class="text-teal-7">کد ملی : </strong>
                                            <span>{{props.row.user.national_code}}</span>
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

        </q-card-section>


    </q-card>

</template>

<script>
import {mapActions} from "vuex";

export default {
    name: "Manage_Requests",
    created() {
        this.GetItems();

    },
    data(){
        return{
            items:[],
            loading_get:true,
            loading_add:false,
            errors:[],
            dialog_detail:[],
            item_columns:[
                {
                    name:'id',
                    required: true,
                    label: 'ID',
                    align: 'left',
                    field: row => row.id,
                    sortable: true
                },
                {
                    name:'user',
                    required: true,
                    label: ' کاربر',
                    align: 'left',
                    field: row => row.user,
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
                    name:'method',
                    required: true,
                    label: 'نوع ثبت',
                    align: 'left',
                    field: row => row.method,
                    sortable: true
                },
                {
                    name:'tools',
                    required: true,
                    label: 'تنظیمات',
                    align: 'left',

                },
            ]
        }
    },
    methods:{
        ...mapActions([
            "InvoicesIndex",
        ]),
        GetItems(){

            this.InvoicesIndex().then(res => {
                this.items = res.data.result;
                this.loading_get=false;
            }).catch(error => {
                this.NotifyServerError();
            });
        },


    }
}
</script>

<style scoped>

</style>
