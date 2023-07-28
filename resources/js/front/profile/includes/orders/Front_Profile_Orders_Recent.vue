<template>
<div class="card">
    <div class="card-body">
        <div class="mt-2">
            <div class="main-title text-dark">خرید های پرتکرار شما</div>
        </div>
        <div class="row mt-3">
            <div v-for="i in 4" class="col-md-3">
                <product_single_recent></product_single_recent>
            </div>


        </div>
    </div>
</div>
</template>

<style scoped>
.main-title{
    font-size: 16px;
    font-weight: 500;
}
.order-image{
    width: 80px;
}
.order-text{
    font-size: 14px;
    font-weight: 450;
}
.order-num{
    font-size: 17px;
    font-weight: 600;
}
</style>
<script>
import {defineComponent} from 'vue'
import Front_Product_Single_Recent from "../../../products/Front_Product_Single_Recent.vue";

export default defineComponent({
    name: "Front_Profile_Orders_Recent",
    components : {
        'product_single_recent' : Front_Product_Single_Recent

    }
})
</script>
