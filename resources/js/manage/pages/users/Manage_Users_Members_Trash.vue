<template>
    <q-card flat bordered>

        <q-card-section class="bg-blue-grey-14 text-white q-pb-lg">
            <strong class="font-16">لیست کاربران حذف شده </strong>
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

                <template v-slot:body-cell-lands="props">
                    <q-td :props="props">
                        <q-btn @click="ShowLandDialog[props.row.id]=true" size="sm" glossy color="purple-8" ><span class="font-13 q-mr-sm">{{props.row.lands.length}}</span> - مشاهده</q-btn>
                    </q-td>
                    <q-dialog
                        v-model="ShowLandDialog[props.row.id]"
                        transition-show="scale"
                        transition-hide="scale"
                        position="top"
                    >
                        <q-card style="max-width: 1024px;width: 960px">
                            <q-card-section class="bg-purple-8 text-white">
                                <strong>لیست زمین های {{props.row.name}}  </strong>
                            </q-card-section>
                            <q-card-section >
                                <lands_table :lands="props.row.lands" />

                            </q-card-section>

                            <q-card-actions align="right">
                                <q-btn  label="بستن" color="red" v-close-popup />

                            </q-card-actions>
                        </q-card>
                    </q-dialog>




                </template>
                <template v-slot:body-cell-referrals="props">
                    <q-td :props="props">
                        <q-chip color="indigo" text-color="white" size="sm">{{props.row.referrals_count}}</q-chip>
                    </q-td>
                </template>
                <template v-slot:body-cell-tools="props">
                    <q-td :props="props">

                        <q-btn :to="{name : 'users_members_details',params : {id : props.row.id}}" glossy color="teal" size="sm" icon="mdi-menu" class="q-mx-xs">
                            <q-tooltip class="bg-grey-9">مدیریت کاربر</q-tooltip>
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
import Manage_Lands_Item from "@/manage/pages/lands/Manage_Lands_Item.vue";
import Manage_Lands_Table from "@/manage/pages/lands/Manage_Lands_Table.vue";

export default {
    name: "Manage_Users_Members",
    components:{
      'member_edit' : Manage_Users_Members_Edit,
        'land_item' : Manage_Lands_Item,
        'lands_table' : Manage_Lands_Table,
    },
    mounted() {
        this.GetItems();
    },
    data(){
        return{
            items:[],
            loading_get:true,
            errors:[],
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
                    name:'lands',
                    required: true,
                    label: 'زمین ها',
                    align: 'left',
                    field: row => row.referrals_count,
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
                this.add=this.add_empty;
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


    }
}
</script>

<style scoped>

</style>
