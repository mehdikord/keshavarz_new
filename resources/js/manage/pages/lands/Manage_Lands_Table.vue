<script>
import member_edit from "@/manage/pages/users/Manage_Users_Members_Edit.vue";

export default {
    name: "Manage_Lands_Table",
    components: {member_edit},
    props:['lands'],
    data(){

        return {

            item_columns:[

                {
                    name:'image',
                    required: true,
                    label: 'تصویر',
                    align: 'left',
                    field: row => row.image,
                    sortable: true
                },
                {
                    name:'name',
                    required: true,
                    label: 'عنوان',
                    align: 'left',
                    field: row => row.title,
                    sortable: true
                },

                {
                    name:'area',
                    required: true,
                    label: 'متراژ',
                    align: 'left',
                    field: row => row.area,
                    sortable: true
                },
                {
                    name:'description',
                    required: true,
                    label: 'دریافت خدمات',
                    align: 'left',
                    field: row => row.requests_count,
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
    }
}
</script>

<template>

    <q-table
        :rows="lands"
        row-key="id"
        :columns="item_columns"
        color="indigo"
        table-header-class="text-indigo"
        separator="horizontal"
        :pagination="{rowsPerPage:30}"

    >
        <template v-slot:loading>
            <Global_Loading></Global_Loading>
        </template>
        <template v-slot:body-cell-image="props">
            <q-td :props="props">
                <Global_Show_Image :image="props.row.image"></Global_Show_Image>
            </q-td>
        </template>
        <template v-slot:body-cell-area="props">
            <q-td :props="props">
                <strong class="text-green-8">{{this.$filters.numbers(props.row.area)}}</strong>
            </q-td>
        </template>

        <template v-slot:body-cell-tools="props">
            <q-td :props="props">

                <q-btn  glossy color="red-9" size="sm" icon="mdi-delete" class="q-mx-xs">
                    <q-tooltip class="bg-grey-9">حذف </q-tooltip>
                </q-btn>
            </q-td>
        </template>


    </q-table>

</template>

<style scoped>

</style>
