<template>
<div class="card">
    <div class="card-body">
        <div class="mt-2">
            <span class="float-right text-blue"> مشاهده همه <i class="fas fa-arrow-left"></i></span>
            <div class="main-title text-dark">سفارش های من</div>
        </div>
        <div class="row mt-5">
            <div class="col-lg-4 col-md-4 text-center">
                <q-img src="/front/images/order-waiting.png" class="order-image"/>
                <div class="text-center mt-2 text-indigo order-text">
                    سفارشات جاری
                </div>
                <div class="text-center mt-2 text-indigo order-num">
                    2
                </div>
            </div>
            <div class="col-lg-4 col-md-4 text-center">
                <q-img src="/front/images/order-done.png" class="order-image"/>
                <div class="text-center mt-2 text-success order-text">
                    سفارشات پایان یافته
                </div>
                <div class="text-center mt-2 text-success order-num">
                    8
                </div>
            </div>
            <div class="col-lg-4 col-md-4 text-center">
                <q-img src="/front/images/order-returned.png" class="order-image"/>
                <div class="text-center mt-2 text-yellow-10 order-text">
                    سفارشات مرجوعی
                </div>
                <div class="text-center mt-2 text-yellow-10 order-num">
                    3
                </div>
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

export default defineComponent({
    name: "Front_Profile_Orders_Index",
})
</script>
