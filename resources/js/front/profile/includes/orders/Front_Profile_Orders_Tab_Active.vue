<template>
    <div class="row">
        <div v-for="i in 2" class="col-lg-12 col-md-12 mt-3">
            <orders_single_active></orders_single_active>
        </div>



    </div>
</template>

<style scoped>

</style>
<script>
import {defineComponent} from 'vue'
import Front_Profile_Orders_Single_Active
    from "@/front/profile/includes/orders/single/Front_Profile_Orders_Single_Active.vue";

export default defineComponent({
    name: "Front_Profile_Orders_Tab_Active",
    components:{
        'orders_single_active' : Front_Profile_Orders_Single_Active

    }
})
</script>
