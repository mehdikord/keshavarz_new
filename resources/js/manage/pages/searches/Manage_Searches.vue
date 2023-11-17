<template>
    <q-card flat bordered>

        <q-card-section class="bg-blue-grey-14 text-white q-pb-lg">


            <strong class="font-16">جستجوهای کاربران برای دریافت خدمات</strong>
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
                <template v-slot:body-cell-user="props">
                    <q-td :props="props">
                        <Global_Show_Image :image="props.row.user.profile"></Global_Show_Image>
                        <span class="q-ml-xs">{{props.row.user.name}}</span>
                    </q-td>
                </template>
                <template v-slot:body-cell-implement="props">
                    <q-td :props="props">
                        <Global_Show_Image :image="props.row.implement.image"></Global_Show_Image>
                        <span class="q-ml-xs">{{props.row.implement.name}}</span>
                    </q-td>
                </template>
                <template v-slot:body-cell-area="props">
                    <q-td :props="props">
                        <template v-if="props.row.land">
                            <strong class="text-red-8">{{this.$filters.numbers(props.row.land.area)}}</strong>
                            <span class="q-mr-xs">m</span>
                        </template>
                    </q-td>
                </template>

<!--                <template v-slot:body-cell-tools="props">-->
<!--                    <q-td :props="props">-->
<!--                        <q-btn @click="DeleteItem(props.row.id)" glossy color="red-9" size="sm" icon="mdi-delete" class="q-mx-xs">-->
<!--                            <q-tooltip class="bg-grey-9">حذف این آیتم</q-tooltip>-->
<!--                        </q-btn>-->
<!--                    </q-td>-->

<!--                </template>-->


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
            dialog_message:[],
            item_columns:[
                {
                    name:'user',
                    required: true,
                    label: 'کاربر',
                    align: 'left',
                    field: row => row.user,
                    sortable: true
                },
                {
                    name:'implement',
                    required: true,
                    label: 'ادوات',
                    align: 'left',
                    field: row => row.implement,
                    sortable: true
                },
                {
                    name:'area',
                    required: true,
                    label: 'متراژ زمین',
                    align: 'left',
                    field: row => row.location,
                    sortable: true
                },
                {
                    name:'result',
                    required: true,
                    label: 'خدمات دهنده',
                    align: 'left',
                    field: row => row.provider,
                    sortable: true
                },
                {
                    name:'result',
                    required: true,
                    label: 'نتایج جستجو',
                    align: 'left',
                    field: row => row.search_result_decode,
                    sortable: true
                },
                {
                    name:'result',
                    required: true,
                    label: 'وضعیت',
                    align: 'left',
                    field: row => row.status,
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
            "SearchIndex",
            "SearchDelete"
        ]),
        GetItems(){

            this.SearchIndex().then(res => {
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
                this.SearchDelete(id).then(res => {
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
