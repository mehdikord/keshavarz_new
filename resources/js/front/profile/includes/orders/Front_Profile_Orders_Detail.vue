<template>
    <div class="card">
        <div class="card-body">
            <div>
                <router-link :to="{name : 'profile_orders'}" class="detail-title text-dark">
                    <strong><i class="fas fa-arrow-right text-red"></i> جزئیات سفارش</strong>
                </router-link>
                <strong class="float-right factor-text text-blue-9">
                    <q-icon name="fas fa-file-invoice-dollar font-16" />
                    مشاهده فاکتور
                </strong>
            </div>
            <div>
                <hr>
            </div>
            <div class=" mb-4 row q-col-gutter-x-lg">
                <div class="col-auto mt-3">
                    <q-icon name="fas fa-circle font-7" color="red"></q-icon>
                    <span class="me-1 text-muted title-info">تاریخ : </span>
                    <strong class="me-1 sub-info text-dark">5 خرداد 1402</strong>
                </div>
                <div class="col-auto mt-3">
                    <q-icon name="fas fa-circle font-7" color="red"></q-icon>
                    <span class="me-1 text-muted title-info">کد سفارش : </span>
                    <strong class="me-1 sub-info text-dark">4875937534</strong>
                </div>
                <div class="col-auto mt-3">
                    <q-icon name="fas fa-circle font-7" color="red"></q-icon>
                    <span class="me-1 text-muted title-info">مبلغ سفارش : </span>
                    <strong class="me-1 sub-info text-price text-success">980,000</strong>
                    <span class="me-1 text-currency">تومان</span>
                </div>
                <div class="col-auto mt-3">
                    <q-icon name="fas fa-circle font-7" color="red"></q-icon>
                    <span class="me-1 text-muted title-info">وضعیت پرداخت : </span>
                    <strong class="me-1 sub-info text-success">
                        <q-icon name="fas fa-check"  />
                        پرداخت شده
                    </strong>
                </div>
            </div>
            <div>
                <hr>
            </div>
            <div class="mb-4 row q-col-gutter-x-md">
                <div class="col-auto mt-3">
                    <q-icon name="fas fa-circle font-7" color="red"></q-icon>
                    <span class="me-1 text-muted title-info">تحویل گیرنده : </span>
                    <strong class="me-1 sub-info text-dark"> محمد عزیزی</strong>
                </div>
                <div class="col-auto mt-3">
                    <q-icon name="fas fa-circle font-7" color="red"></q-icon>
                    <span class="me-1 text-muted title-info">شماره موبایل : </span>
                    <strong class="me-1 sub-info text-dark"> 09117926950</strong>
                </div>
                <div class="col-12 mt-3">
                    <q-icon name="fas fa-circle font-7" color="red"></q-icon>
                    <span class="me-1 text-muted title-info">کد پستی : </span>
                    <strong class="me-1 sub-info text-dark">
                        523624158
                    </strong>
                </div>
                <div class="col-12 mt-3">
                    <q-icon name="fas fa-circle font-7" color="red"></q-icon>
                    <span class="me-1 text-muted title-info">آدرس ارسال : </span>
                    <strong class="me-1 sub-info text-dark">
                    گرگان خیابان ولیعصر عدالت 8 ساختمان آریا واحد 5
                    </strong>
                </div>
            </div>
            <div>
                <hr>
            </div>
            <div class="mb-4 row q-col-gutter-x-md">
                <div class="col-12 ">
                    <strong class="detail-title text-red">اطلاعات پرداخت</strong>
                </div>
                <div class="col-auto mt-3">
                    <q-icon name="fas fa-circle font-7" color="red"></q-icon>
                    <span class="me-1 text-muted title-info">کد فاکتور : </span>
                    <strong class="me-1 sub-info text-red">521414625</strong>
                </div>
                <div class="col-auto mt-3">
                    <q-icon name="fas fa-circle font-7" color="red"></q-icon>
                    <span class="me-1 text-muted title-info">مبلغ سفارش : </span>
                    <strong class="me-1 sub-info text-price text-success">980,000</strong>
                    <span class="me-1 text-currency">تومان</span>
                </div>
                <div class="col-auto mt-3">
                    <q-icon name="fas fa-circle font-7" color="red"></q-icon>
                    <span class="me-1 text-muted title-info">هزینه ارسال : </span>
                    <strong class="me-1 sub-info text-price text-success">10,000</strong>
                    <span class="me-1 text-currency">تومان</span>
                </div>
                <div class="col-auto mt-3">
                    <q-icon name="fas fa-circle font-7" color="red"></q-icon>
                    <span class="me-1 text-muted title-info">مبلغ کل : </span>
                    <strong class="me-1 sub-info text-price text-success">990,000</strong>
                    <span class="me-1 text-currency">تومان</span>
                </div>
                <div class="col-auto mt-3">
                    <q-icon name="fas fa-circle font-7" color="red"></q-icon>
                    <span class="me-1 text-muted title-info">روش پرداخت : </span>
                    <strong class="me-1 sub-info text-blue-8">پرداخت آنلاین</strong>
                </div>
            </div>
            <div>
                <hr>
            </div>
            <div class="mb-4">
                <div class="col-12 mb-3">
                    <strong class="detail-title text-red"> لیست محصولات </strong>
                </div>
                <div class="row mt-3">
                    <div v-for="i in 6" class="col-12 p-0">
                        <product_single_order></product_single_order>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<style scoped>
.detail-title{
    font-size: 14px;
}
.factor-text{
    font-size: 12px;
}
.title-info{
    font-size: 13px;
    font-width: 400px;
}
.sub-info{
    font-size: 13px;
    font-weight: 500;
}
.text-price{
    font-size: 14px;
    font-weight: 600;
}
.text-currency{
    font-size: 12px;
}
</style>
<script>
import {defineComponent} from 'vue'
import Front_Product_Single_Order from "../../../products/Front_Product_Single_Order.vue";

export default defineComponent({
    name: "Front_Profile_Orders_Detail",
    components :{
        'product_single_order' : Front_Product_Single_Order,
    }
})
</script>

