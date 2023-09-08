<template>
    <q-card flat bordered>

        <q-card-section class="bg-blue-grey-14 text-white q-pb-lg">


            <strong class="font-16">لیست پیام های ارسالی</strong>
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
                <template v-slot:body-cell-message="props">
                    <q-td :props="props">
                        <q-btn color="deep-purple" @click="dialog_message[props.row.id] = true">مشاهده پیام</q-btn>
                        <q-dialog
                            v-model="dialog_message[props.row.id]"
                            transition-show="scale"
                            transition-hide="scale"
                            position="top"
                        >
                            <q-card style="max-width: 700px;width: 700px">
                                <q-card-section class="bg-deep-purple text-white">
                                    <strong>مشاهده پیام : {{props.row.name}}</strong>
                                </q-card-section>
                                <q-card-section >
                                    <p class="text-justify">
                                        {{props.row.message}}
                                    </p>
                                </q-card-section>

                                <q-card-actions align="right">
                                    <q-btn  label="بستن" color="red" v-close-popup />
                                </q-card-actions>
                            </q-card>
                        </q-dialog>

                    </q-td>
                </template>
                <template v-slot:body-cell-tools="props">
                    <q-td :props="props">
                        <q-btn @click="DeleteItem(props.row.id)" glossy color="red-9" size="sm" icon="mdi-delete" class="q-mx-xs">
                            <q-tooltip class="bg-grey-9">حذف این آیتم</q-tooltip>
                        </q-btn>
                    </q-td>

                </template>


            </q-table>

        </q-card-section>


    </q-card>

</template>

<script>
import {mapActions} from "vuex";

export default {
    name: "Manage_Faqs",
    created() {
        this.GetItems();

    },
    data(){
        return{
            items:[],
            loading_get:true,
            loading_add:false,
            errors:[],
            dialog_message:[],
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
                    label: 'شماره موبایل',
                    align: 'left',
                    field: row => row.phone,
                    sortable: true
                },
                {
                    name:'email',
                    required: true,
                    label: 'ایمیل',
                    align: 'left',
                    field: row => row.email,
                    sortable: true
                },
                {
                    name:'message',
                    required: true,
                    label: 'متن پیام',
                    align: 'left',
                    field: row => row.message,
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

        GetItems(){

            axios.get('contacts').then(res => {
                this.items = res.data.result;
                this.loading_get=false;
            }).catch(error => {
                this.NotifyServerError();
            });
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
                axios.delete("contacts/"+id).then(res => {
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

<style scoped>

</style>
