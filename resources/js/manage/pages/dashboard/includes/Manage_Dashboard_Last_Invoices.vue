<script>
export default {
    name: "Manage_Dashboard_Last_Invoices",
    mounted() {
        this.GetItems();
    },
    data(){
        return {
            loading:true,
            items:[],
            item_columns:[
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
            ]
        }
    },
    methods: {
        GetItems(){
            axios.get('dashboard/last/invoices').then(res => {
                this.items = res.data.result;
                this.loading=false;
            }).catch(error => {
                return this.NotifyServerError()
            })

        }
    }
}
</script>

<template>
    <q-card>
        <q-card-section class="bg-primary text-white">
            <strong>
                 آخرین اشتراک های خریداری شده
            </strong>
        </q-card-section>
        <q-card-section class="q-pa-none">
            <Global_Loading v-if="loading"></Global_Loading>
            <template v-else>
                <q-table
                    :rows="items"
                    row-key="id"
                    :columns="item_columns"
                    color="indigo"
                    table-header-class="text-indigo"
                    separator="cell"
                    :pagination="{rowsPerPage:30}"
                >
                    <template v-slot:body-cell-user="props">
                        <q-td :props="props">
                            <Global_Show_Image :image="props.row.user.profile"></Global_Show_Image>
                            <strong class="text-red q-ml-sm">
                                {{props.row.user.name}}
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
                            <q-chip  class="font-12" v-if="props.row.is_pay" color="positive" text-color="white" icon="mdi-check">پرداخت شده</q-chip>
                            <q-chip  class="font-12" v-else color="red" text-color="white" icon="mdi-close">پرداخت نشده</q-chip>
                        </q-td>
                    </template>
                    <template v-slot:body-cell-type="props">
                        <q-td :props="props">
                            <q-chip class="font-12" dense v-if="props.row.plan_type === 'provider'" color="deep-orange-7" text-color="white" >اشتراک خدمات دهنده</q-chip>
                            <q-chip class="font-12" dense v-else-if="props.row.plan_type === 'customer'" color="indigo-7" text-color="white" > اشتراک خدمات گیرنده</q-chip>
                            <q-chip class="font-12" dense v-else color="indigo-7" text-color="white" >خرید از فروشگاه</q-chip>
                        </q-td>
                    </template>
                    <template v-slot:body-cell-method="props">
                        <q-td :props="props">
                            <q-chip dense color="deep-purple" text-color="white">{{props.row.method}}</q-chip>
                        </q-td>
                    </template>

                </q-table>
            </template>
        </q-card-section>
    </q-card>
</template>

<style scoped>

</style>
