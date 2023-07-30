<template>
    <div class="card">
        <div class="card-body">
            <div>
                <q-icon class="fa fa-check font-16" color="success"></q-icon>
                <strong class="me-2 text-dark">تحویل داده شده</strong>
                <q-icon class="fas fa-chevron-left float-right text-blue-9 font-14"></q-icon>
            </div>
            <div class="mt-3 row q-col-gutter-x-md">
                <div class="col">
                    <q-icon name="fas fa-circle font-7" color="red"></q-icon>
                    <span class="me-1 text-muted title-info">تاریخ : </span>
                    <strong class="me-1 sub-info text-dark">5 خرداد 1402</strong>
                </div>
                <div class="col">
                    <q-icon name="fas fa-circle font-7" color="red"></q-icon>
                    <span class="me-1 text-muted title-info">کد سفارش : </span>
                    <strong class="me-1 sub-info text-dark">4875937534</strong>
                </div>
                <div class="col">
                    <q-icon name="fas fa-circle font-7" color="red"></q-icon>
                    <span class="me-1 text-muted title-info">مبلغ سفارش : </span>
                    <strong class="me-1 sub-info text-price text-success">980,000</strong>
                    <span class="me-1 text-currency">تومان</span>
                </div>
            </div>
            <div class="mt-1 mb-1">
                <hr>
            </div>
            <div>
                <strong class="text-dark">کالاها : </strong>
                <div class="row">
                    <div v-for="i in 5" class="mt-2 col-lg-2 p-1">
                        <q-img class="product-image" src="https://tamkins.com/wp-content/uploads/2022/11/Layer-30-1200x1200.png" />
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer p-3">
            <strong class="float-right factor-text text-blue-9">
                <q-icon name="fas fa-file-invoice-dollar font-16" />
                مشاهده فاکتور
            </strong>
        </div>
    </div>
</template>

<style scoped>
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
.product-image{
    width: 100px;
}
.factor-text{
    font-size: 12px;
}
</style>
<script>
import {defineComponent} from 'vue'


export default defineComponent({
    name: "Front_Profile_Orders_Single_Active",

})
</script>
