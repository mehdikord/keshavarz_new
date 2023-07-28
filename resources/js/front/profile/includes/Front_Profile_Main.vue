
<template>
    <div class="row">
        <div class="col-lg-12">
            <orders_index></orders_index>
        </div>
        <div class="col-lg-12 mt-3">
            <orders_recent></orders_recent>
        </div>
    </div>

</template>

<style scoped>

</style>
<script>
import {defineComponent} from 'vue'
import orders_recent from "./orders/Front_Profile_Orders_Recent.vue";
import orders_index from "./orders/Front_Profile_Orders_Index.vue";

export default defineComponent({
    name: "Front_Profile_Main",
    components: {orders_index, orders_recent}
})
</script>
