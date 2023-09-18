<script>
import Manage_Dashboard_Main_Info from "./includes/Manage_Dashboard_Main_Info.vue";
import Manage_Dashboard_Last_Invoices from "./includes/Manage_Dashboard_Last_Invoices.vue";
import Manage_Dashboard_Last_Users from "./includes/Manage_Dashboard_Last_Users.vue";
import Manage_Dashboard_Payments from "./includes/Manage_Dashboard_Payments.vue";

export default {
    name: "Manage_Dashboard",
    components:{
        'main_info' : Manage_Dashboard_Main_Info,
        'last_invoices' : Manage_Dashboard_Last_Invoices,
        'last_users' : Manage_Dashboard_Last_Users,
        'payments' : Manage_Dashboard_Payments,
    }
}
</script>
<template>
    <main_info/>
    <div class="row q-mt-lg">
        <div class="col-md-6 col-sm-12 col-xs-12 q-px-xs">
            <last_invoices></last_invoices>
        </div>
        <div class="col-md-6 col-sm-12 col-xs-12 q-px-xs">
            <last_users></last_users>
        </div>

        <div class="col-12 q-mt-lg q-px-sm">
            <payments></payments>
        </div>

    </div>

</template>


<style scoped>

</style>
