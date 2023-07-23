
<template>
    <h6 class="shop-widget-title font-15">تعیین بازه قیمت</h6>
    <form>
        <div class="shop-widget-group">
            <input type="text" placeholder="از مبلغ">
            <input type="text" placeholder="تا مبلغ">
        </div>
        <button class="shop-widget-btn sm-hide xs-hide">
            <i class="fas fa-search"></i><span>ثبت قیمت </span>
        </button>
    </form>
</template>

<style scoped>
@media only screen and (max-width: 600px) {
    .shop-widget-title{
        font-size: 13px!important;
    }
}


</style>
<script>
import {defineComponent} from 'vue'

export default defineComponent({
    name: "Front_Shop_Filter_Price"
})
</script>
