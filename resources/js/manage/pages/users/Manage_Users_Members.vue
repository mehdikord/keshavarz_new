<template>
    <q-card flat bordered>

        <q-card-section class="bg-blue-grey-14 text-white q-pb-lg">
            <q-btn @click="dialog_add=true" color="deep-orange-7" icon="mdi-plus" push class="float-right" label="فزودن آیتم"></q-btn>
            <q-dialog
                v-model="dialog_add"

                transition-show="scale"
                transition-hide="scale"
                position="top"
            >
                <q-card style="max-width: 700px;width: 700px">
                    <q-card-section class="bg-deep-orange-9 text-white">
                        <strong> افزودن آیتم جدید</strong>
                    </q-card-section>
                    <q-card-section >
                        <q-input v-model="add.name"  lazy-rules type="text" outlined label="نام" color="primary" class="q-my-xs" :error="this.MixinValidationCheck(errors,'name')">
                            <template v-slot:error>
                                <Error_Validation :errors="this.MixinValidation(errors,'email')"></Error_Validation>
                            </template>
                        </q-input>
                        <q-input v-model="add.phone" lazy-rules type="number" outlined label="موبایل" color="primary" class="q-my-xs" :error="this.MixinValidationCheck(errors,'phone')">
                            <template v-slot:error>
                                <Error_Validation :errors="this.MixinValidation(errors,'phone')"></Error_Validation>
                            </template>
                        </q-input>
                        <q-input v-model="add.national_code" lazy-rules type="number" outlined label="کد ملی" color="primary" class="q-my-xs" :error="this.MixinValidationCheck(errors,'national_code')">
                            <template v-slot:error>
                                <Error_Validation :errors="this.MixinValidation(errors,'national_code')"></Error_Validation>
                            </template>
                        </q-input>
                        <q-select
                            outlined
                            v-model="add.province_id"
                            class="q-my-xs"
                            color="primary"
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
                        <q-select
                            outlined
                            class="q-my-xs"
                            v-model="add.city_id"
                            color="primary"
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

                    </q-card-section>

                    <q-card-actions align="right">
                        <q-btn  label="بستن" color="red" v-close-popup />
                        <q-btn @click="AddItem" :loading="loading_add" label="افزودن آیتم" color="green-9"/>
                    </q-card-actions>
                </q-card>
            </q-dialog>

            <strong class="font-16">لیست مشتریان فروشگاه </strong>
        </q-card-section>

        <q-card-section>

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
                <template v-slot:body-cell-profile="props">
                    <q-td :props="props">
                        <Global_Show_Image :image="props.row.profile"></Global_Show_Image>
                    </q-td>
                </template>
                <template v-slot:body-cell-phone="props">
                    <q-td :props="props">
                        <div v-if="props.row.phone">
                            <q-chip color="teal-4" class="font-12">{{props.row.phone}}</q-chip>
                        </div>
                    </q-td>
                </template>
                <template v-slot:body-cell-is_provider="props">
                    <q-td :props="props" >
                        <Global_Status :status="props.row.is_provider"></Global_Status>
                    </q-td>
                </template>
                <template v-slot:body-cell-is_customer="props">
                    <q-td :props="props">
                        <Global_Status :status="props.row.is_customer"></Global_Status>

                    </q-td>
                </template>
                <template v-slot:body-cell-is_active="props">
                    <q-td :props="props">
                        <q-toggle
                            v-model="props.row.is_active"
                            :false-value="0"
                            :true-value="1"
                            icon="mdi-check"
                            color="green-7"
                            @click="ChangeStatus(props.row.id)"
                        />
                    </q-td>
                </template>
                <template v-slot:body-cell-referrals="props">
                    <q-td :props="props">
                        <q-chip color="indigo" text-color="white" size="sm">{{props.row.referrals_count}}</q-chip>
                    </q-td>
                </template>
                <template v-slot:body-cell-tools="props">
                    <q-td :props="props">
                        <member_edit :data="props.row" @UpdateEditedItem="GetItems"></member_edit>
                        <q-btn @click="DeleteItem(props.row.id)" glossy color="red-9" size="sm" icon="mdi-delete" class="q-mx-xs">
                            <q-tooltip class="bg-grey-9">Delete this item</q-tooltip>
                        </q-btn>
                    </q-td>


                </template>


            </q-table>

        </q-card-section>


    </q-card>

</template>

<script>
import {mapActions} from "vuex";
import Manage_Users_Members_Edit from "./Manage_Users_Members_Edit.vue";

export default {
    name: "Manage_Users_Members",
    components:{
      'member_edit' : Manage_Users_Members_Edit,
    },
    mounted() {
        this.GetItems();
        this.GetProvinces();
    },
    data(){
        return{
            items:[],
            loading_get:true,
            loading_add:false,
            errors:[],
            dialog_add:false,
            dialog_edit:[],
            provinces:[],
            provinces_select:[],
            cities_select:[],
            add:{
                name:null,
                province_id:null,
                city_id:null,
                national_code:null,
                phone:null,

            },
            item_columns:[

                {
                    name:'profile',
                    required: true,
                    label: 'تصویر',
                    align: 'left',
                    field: row => row.profile,
                    sortable: true
                },
                {
                    name:'name',
                    required: true,
                    label: 'نام',
                    align: 'left',
                    field: row => row.name,
                    sortable: true
                },

                {
                    name:'phone',
                    required: true,
                    label: 'موبایل',
                    align: 'left',
                    field: row => row.phone,
                    sortable: true
                },
                {
                    name:'is_provider',
                    required: true,
                    label: 'خدمات دهنده',
                    align: 'left',
                    field: row => row.is_provider,
                    sortable: true
                },
                {
                    name:'is_customer',
                    required: true,
                    label: 'خدمات گیرنده',
                    align: 'left',
                    field: row => row.is_customer,
                    sortable: true
                },

                {
                    name:'is_active',
                    required: true,
                    label: 'وضعیت حساب',
                    align: 'left',
                    field: row => row.is_active,
                    sortable: true
                },
                {
                    name:'referrals',
                    required: true,
                    label: 'زیر مجموعه',
                    align: 'left',
                    field: row => row.referrals_count,
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
            "UserMembersIndex",
            "UserMembersStore",
            "UserMembersDelete",
            "UserMembersEdit",
            "UserMembersDChangeStatus"

        ]),
        GetProvinces(){
            axios.get('helpers/provinces').then(res =>{
                this.provinces = res.data.result;
                this.provinces.forEach(province => {
                    this.provinces_select.push({label : province.name , value : province.id})
                })
            })
        },
        GetItems(){

            this.UserMembersIndex().then(res => {
                this.items = res.data.result;
                this.loading_get=false;
            }).catch(error => {
                this.NotifyServerError();
            });
        },
        AddItem(){
            this.loading_add=true;
            this.UserMembersStore(this.add).then(res => {
                this.items.unshift(res.data.result);
                this.loading_add=false;
                this.dialog_add=false;
                this.add=[];
                return this.NotifyCreate();
            }).catch(error => {
                this.loading_add=false;
                if (error.response.status === 422) {
                    return this.errors = error.response.data
                }
                return  this.NotifyServerError();

            })
        },

        DeleteItem (id) {
            this.$q.dialog({
                title: 'هشدار !',
                message: 'آیا مطمئن هستید آیتم مورد نظر حذف شود ؟',

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
                this.UserMembersDelete(id).then(res => {
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
        },
        ChangeStatus(id){
            this.UserMembersDChangeStatus(id).then(res => {
                return this.NotifySuccess('وضعیت حساب باموفقیت تغییر کرد');
            }).catch(error => {
                return this.NotifyServerError();
            })
        },


    },
    computed:{
        GetCities(){
            if (this.add.province_id){
                let cities;
                this.provinces.forEach(province =>{
                    if (province.id === this.add.province_id){
                        cities = province.cities;
                    }
                })
                this.cities_select=[];
                cities.forEach(city => {
                    this.cities_select.push({label : city.name , value : city.id})
                })
            }
        },


    }
}
</script>

<style scoped>

</style>
