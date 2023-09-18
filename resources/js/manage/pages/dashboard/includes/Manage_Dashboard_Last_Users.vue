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
                    name:'name',
                    required: true,
                    label: 'نام',
                    align: 'left',
                    field: row => row.name,
                    sortable: true
                },
                {
                    name:'province',
                    required: true,
                    label: 'استان',
                    align: 'left',
                    field: row => row.province,
                    sortable: true
                },
                {
                    name:'city',
                    required: true,
                    label: 'شهر',
                    align: 'left',
                    field: row => row.city,
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
            ]
        }
    },
    methods: {
        GetItems(){
            axios.get('dashboard/last/users').then(res => {
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
        <q-card-section class="bg-deep-purple text-white">
            <strong>
                آخرین کاربران اضافه شده به کشاورز
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
                    <template v-slot:body-cell-name="props">
                        <q-td :props="props">
                            <Global_Show_Image :image="props.row.profile"></Global_Show_Image>
                            <strong class="text-dark q-ml-sm font-13">
                                {{props.row.name}}
                            </strong>
                        </q-td>
                    </template>
                    <template v-slot:body-cell-province="props">
                        <q-td :props="props">
                            <span v-if="props.row.province">
                                {{props.row.province.name}}
                            </span>
                        </q-td>
                    </template>
                    <template v-slot:body-cell-city="props">
                        <q-td :props="props">
                            <span v-if="props.row.city">
                                {{props.row.city.name}}
                            </span>
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

                </q-table>
            </template>
        </q-card-section>
    </q-card>
</template>

<style scoped>

</style>
